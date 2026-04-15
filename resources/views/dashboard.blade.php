@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Income</h5>
                <h3>${{ number_format($totalIncome, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Total Expenses</h5>
                <h3>${{ number_format($totalExpense, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Balance</h5>
                <h3>${{ number_format($balance, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Recent Expenses</h5>
            </div>
            <div class="card-body">
                @if($recentExpenses->isEmpty())
                    <p class="text-muted">No expenses yet.</p>
                @else
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                                <tr>
                                    <td>{{ $expense->title }}</td>
                                    <td>${{ number_format($expense->amount, 2) }}</td>
                                    <td>{{ $expense->date->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Recent Income</h5>
            </div>
            <div class="card-body">
                @if($recentIncomes->isEmpty())
                    <p class="text-muted">No income records yet.</p>
                @else
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Source</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentIncomes as $income)
                                <tr>
                                    <td>{{ $income->source }}</td>
                                    <td>${{ number_format($income->amount, 2) }}</td>
                                    <td>{{ $income->date->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-center">
    <a href="{{ route('expenses.create') }}" class="btn btn-danger me-2">Add Expense</a>
    <a href="{{ route('incomes.create') }}" class="btn btn-success">Add Income</a>
</div>
@endsection
