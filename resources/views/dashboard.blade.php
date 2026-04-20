@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-dashboard-line"></i>
    Welcome back, {{ auth()->user()->name }}!
</h1>

@if(!empty($budgetWarnings))
<div class="row mb-4">
    <div class="col-12">
        @foreach($budgetWarnings as $warning)
            @if($warning['status'] == 'exceeded')
                <div class="alert alert-danger mb-2">
                    <i class="ri-error-warning-line me-2"></i>
                    <strong>❌ Budget Exceeded:</strong> {{ $warning['category'] }} - ₱{{ number_format($warning['spent'], 2) }} / ₱{{ number_format($warning['budget'], 2) }}
                </div>
            @else
                <div class="alert alert-warning mb-2">
                    <i class="ri-alert-line me-2"></i>
                    <strong>⚠️ Warning: Near budget limit</strong> for {{ $warning['category'] }} - ₱{{ number_format($warning['spent'], 2) }} / ₱{{ number_format($warning['budget'], 2) }}
                </div>
            @endif
        @endforeach
    </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card income">
            <i class="ri-arrow-up-circle-line stat-icon"></i>
            <p>Total Income</p>
            <h3>₱{{ number_format($totalIncome, 2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card expense">
            <i class="ri-arrow-down-circle-line stat-icon"></i>
            <p>Total Expenses</p>
            <h3>₱{{ number_format($totalExpense, 2) }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card balance">
            <i class="ri-wallet-3-line stat-icon"></i>
            <p>Current Balance</p>
            <h3>₱{{ number_format($balance, 2) }}</h3>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12 text-center">
        <a href="{{ route('expenses.create') }}" class="btn btn-danger me-2">
            <i class="ri-add-circle-line me-1"></i> Add Expense
        </a>
        <a href="{{ route('incomes.create') }}" class="btn btn-success me-2">
            <i class="ri-add-circle-line me-1"></i> Add Income
        </a>
        <a href="{{ route('budgets.index') }}" class="btn btn-dark">
            <i class="ri-money-dollar-circle-line me-1"></i> Set Budgets
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="recent-header expense">
                <i class="ri-pie-chart-line"></i> Expenses by Category
            </div>
            <div class="card-body">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card h-100">
            <div class="recent-header income">
                <i class="ri-line-chart-line"></i> Monthly Income vs Expenses
            </div>
            <div class="card-body">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="recent-header expense">
                <i class="ri-bar-chart-line"></i> Weekly Spending
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="recent-header expense">
                <i class="ri-shopping-cart-line"></i> Recent Expenses
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
                                    <td class="text-danger">-₱{{ number_format($expense->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('M d') }}</td>
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
                <i class="ri-money-dollar-circle-line"></i> Recent Income
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
                                    <td class="text-success">+₱{{ number_format($income->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($income->date)->format('M d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const categoryLabels = @json(array_keys($expensesByCategory));
const categoryData = @json(array_values($expensesByCategory));
const categoryColors = [
    '#800020', '#2E7D32', '#1565C0', '#F57C00', '#7B1FA2',
    '#00838F', '#C62828', '#455A64'
];

new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: categoryLabels,
        datasets: [{
            data: categoryData,
            backgroundColor: categoryColors
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [
            {
                label: 'Income',
                data: @json($monthlyIncome),
                borderColor: '#2E7D32',
                backgroundColor: 'rgba(46, 125, 50, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Expenses',
                data: @json($monthlyExpense),
                borderColor: '#800020',
                backgroundColor: 'rgba(128, 0, 32, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: @json($weekLabels),
        datasets: [{
            label: 'Weekly Spending',
            data: @json($weeklySpending),
            backgroundColor: '#800020'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection