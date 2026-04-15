@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-add-circle-line"></i>
    Add New Income
</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="ri-money-dollar-circle-line me-2"></i>Income Details
            </div>
            <div class="card-body">
                <form action="{{ route('incomes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="source" class="form-label">
                            <i class="ri-briefcase-line me-1"></i>Source
                        </label>
                        <input type="text" name="source" id="source" class="form-control" value="{{ old('source') }}" placeholder="e.g., Monthly Salary" required>
                        @error('source')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">
                            <i class="ri-money-cny-circle-line me-1"></i>Amount
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" placeholder="0.00" required>
                        </div>
                        @error('amount')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">
                            <i class="ri-calendar-line me-1"></i>Date
                        </label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ri-add-circle-line me-2"></i>Add Income
                        </button>
                        <a href="{{ route('incomes.index') }}" class="btn btn-outline-secondary">
                            <i class="ri-arrow-left-line me-1"></i>Back to Income
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
