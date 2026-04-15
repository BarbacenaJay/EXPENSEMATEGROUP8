@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="ri-money-dollar-circle-line"></i>
        Income
    </h1>
    <a href="{{ route('incomes.create') }}" class="btn btn-success">
        <i class="ri-add-circle-line me-1"></i> Add Income
    </a>
</div>

<div class="card">
    @if($incomes->isEmpty())
        <div class="card-body">
            <div class="empty-state">
                <i class="ri-file-list-3-line"></i>
                <h4>No Income Records Yet</h4>
                <p>Start tracking your income by adding your first entry!</p>
                <a href="{{ route('incomes.create') }}" class="btn btn-success">
                    <i class="ri-add-circle-line me-1"></i> Add First Income
                </a>
            </div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><i class="ri-file-text-line me-1"></i>Source</th>
                        <th><i class="ri-money-cny-circle-line me-1"></i>Amount</th>
                        <th><i class="ri-calendar-line me-1"></i>Date</th>
                        <th><i class="ri-settings-line me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incomes as $income)
                        <tr>
                            <td><strong>{{ $income->source }}</strong></td>
                            <td class="text-success fw-bold">+₱{{ number_format($income->amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($income->date)->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('incomes.edit', $income) }}" class="btn btn-sm btn-warning action-btn">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <form action="{{ route('incomes.destroy', $income) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure you want to delete this income?')">
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
