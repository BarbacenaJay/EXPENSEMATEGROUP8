@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-money-dollar-circle-line"></i>
    Set Budgets
</h1>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="ri-add-circle-line me-1"></i> Add Budget
            </div>
            <div class="card-body">
                <form action="{{ route('budgets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <option value="Food">Food</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Education">Education</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Monthly Budget (₱)</label>
                        <input type="number" name="amount" class="form-control" placeholder="e.g. 5000" min="0" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="ri-save-line me-1"></i> Save Budget
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="recent-header expense">
                <i class="ri-list-check"></i> Your Budgets
            </div>
            <div class="card-body">
                @if($budgets->isEmpty())
                    <div class="empty-state">
                        <i class="ri-money-dollar-circle-line"></i>
                        <p>No budgets set yet</p>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Budget</th>
                                <th>Spent</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $categories = $budgets->pluck('category')->toArray();
                                $spent = \Auth::user()->expenses()
                                    ->whereIn('category', $categories)
                                    ->whereMonth('date', now()->month)
                                    ->whereYear('date', now()->year)
                                    ->sum('amount');
                            @endphp
                            @foreach($budgets as $budget)
                                @php
                                    $categorySpent = \Auth::user()->expenses()
                                        ->where('category', $budget->category)
                                        ->whereMonth('date', now()->month)
                                        ->whereYear('date', now()->year)
                                        ->sum('amount');
                                    $percent = $budget->amount > 0 ? ($categorySpent / $budget->amount) * 100 : 0;
                                @endphp
                                <tr>
                                    <td><strong>{{ $budget->category }}</strong></td>
                                    <td>₱{{ number_format($budget->amount, 2) }}</td>
                                    <td>₱{{ number_format($categorySpent, 2) }}</td>
                                    <td>
                                        @if($percent >= 100)
                                            <span class="badge bg-danger">❌ Exceeded</span>
                                        @elseif($percent >= 80)
                                            <span class="badge bg-warning">⚠️ Near Limit</span>
                                        @else
                                            <span class="badge bg-success">OK</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection