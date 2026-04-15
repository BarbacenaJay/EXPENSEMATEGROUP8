@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-dashboard-line"></i>
    Welcome back, {{ auth()->user()->name }}!
</h1>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card income">
            <i class="ri-arrow-up-circle-line stat-icon"></i>
            <p>Total Income</p>
            <h3>${{ number_format($totalIncome, 2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card expense">
            <i class="ri-arrow-down-circle-line stat-icon"></i>
            <p>Total Expenses</p>
            <h3>${{ number_format($totalExpense, 2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card balance">
            <i class="ri-wallet-3-line stat-icon"></i>
            <p>Current Balance</p>
            <h3>${{ number_format($balance, 2) }}</h3>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12 text-center">
        <a href="{{ route('expenses.create') }}" class="btn btn-danger me-2">
            <i class="ri-add-circle-line me-1"></i> Add Expense
        </a>
        <a href="{{ route('incomes.create') }}" class="btn btn-success">
            <i class="ri-add-circle-line me-1"></i> Add Income
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="recent-header expense">
                <i class="ri-shopping-cart-line"></i>
                Recent Expenses
            </div>
            <div class="card-body">
                @if($recentExpenses->isEmpty())
                    <div class="empty-state">
                        <i class="ri-file-list-3-line"></i>
                        <p>No expenses yet</p>
                        <a href="{{ route('expenses.create') }}" class="btn btn-sm btn-danger">Add First Expense</a>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                                <tr>
                                    <td><strong>{{ $expense->title }}</strong></td>
                                    <td><span class="badge bg-secondary">{{ $expense->category }}</span></td>
                                    <td class="text-danger">-${{ number_format($expense->amount, 2) }}</td>
                                    <td>{{ $expense->date->format('M d') }}</td>
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
            <div class="recent-header income">
                <i class="ri-money-dollar-circle-line"></i>
                Recent Income
            </div>
            <div class="card-body">
                @if($recentIncomes->isEmpty())
                    <div class="empty-state">
                        <i class="ri-file-list-3-line"></i>
                        <p>No income records yet</p>
                        <a href="{{ route('incomes.create') }}" class="btn btn-sm btn-success">Add First Income</a>
                    </div>
                @else
                    <table class="table">
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
                                    <td><strong>{{ $income->source }}</strong></td>
                                    <td class="text-success">+${{ number_format($income->amount, 2) }}</td>
                                    <td>{{ $income->date->format('M d') }}</td>
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
