@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Income</h2>
    <a href="{{ route('incomes.create') }}" class="btn btn-success">Add Income</a>
</div>

<div class="card">
    <div class="card-body">
        @if($incomes->isEmpty())
            <p class="text-muted">No income records yet.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incomes as $income)
                        <tr>
                            <td>{{ $income->source }}</td>
                            <td class="text-success">${{ number_format($income->amount, 2) }}</td>
                            <td>{{ $income->date->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('incomes.edit', $income) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('incomes.destroy', $income) }}" method="POST" class="d-inline">
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
