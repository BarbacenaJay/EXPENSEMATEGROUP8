@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Expenses</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
</div>

<div class="card">
    <div class="card-body">
        @if($expenses->isEmpty())
            <p class="text-muted">No expenses recorded yet.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>${{ number_format($expense->amount, 2) }}</td>
                            <td><span class="badge bg-secondary">{{ $expense->category }}</span></td>
                            <td>{{ $expense->date->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
