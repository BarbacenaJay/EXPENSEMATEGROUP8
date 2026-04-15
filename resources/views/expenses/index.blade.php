@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="ri-shopping-cart-line"></i>
        Expenses
    </h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-danger">
        <i class="ri-add-circle-line me-1"></i> Add Expense
    </a>
</div>

<div class="card">
    @if($expenses->isEmpty())
        <div class="card-body">
            <div class="empty-state">
                <i class="ri-file-list-3-line"></i>
                <h4>No Expenses Yet</h4>
                <p>Start tracking your expenses by adding your first entry!</p>
                <a href="{{ route('expenses.create') }}" class="btn btn-danger">
                    <i class="ri-add-circle-line me-1"></i> Add First Expense
                </a>
            </div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><i class="ri-file-text-line me-1"></i>Title</th>
                        <th><i class="ri-money-cny-circle-line me-1"></i>Amount</th>
                        <th><i class="ri-price-tag-3-line me-1"></i>Category</th>
                        <th><i class="ri-calendar-line me-1"></i>Date</th>
                        <th><i class="ri-settings-line me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td><strong>{{ $expense->title }}</strong></td>
                            <td class="text-danger fw-bold">-₱{{ number_format($expense->amount, 2) }}</td>
                            <td>
                                @php
                                    $categoryColors = [
                                        'Food' => 'warning',
                                        'Bills' => 'info',
                                        'Transport' => 'primary',
                                        'Shopping' => 'danger',
                                        'Others' => 'secondary'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $categoryColors[$expense->category] ?? 'secondary' }}">
                                    {{ $expense->category }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning action-btn">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure you want to delete this expense?')">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
