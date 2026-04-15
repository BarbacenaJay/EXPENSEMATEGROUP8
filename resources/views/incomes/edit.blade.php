@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Edit Income</div>
            <div class="card-body">
                <form action="{{ route('incomes.update', $income) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="source" class="form-label">Source</label>
                        <input type="text" name="source" id="source" class="form-control" value="{{ old('source', $income->source) }}" required>
                        @error('source')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount', $income->amount) }}" required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $income->date->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Update Income</button>
                        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
