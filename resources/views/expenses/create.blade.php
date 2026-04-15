@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-add-circle-line"></i>
    Add New Expense
</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="ri-shopping-cart-line me-2"></i>Expense Details
            </div>
            <div class="card-body">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="ri-file-text-line me-1"></i>Title
                        </label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="e.g., Lunch at restaurant" required>
                        @error('title')
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
                        <label for="category" class="form-label">
                            <i class="ri-price-tag-3-line me-1"></i>Category
                        </label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                            <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>Bills</option>
                            <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>Transport</option>
                            <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                            <option value="Others" {{ old('category') == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('category')
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
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="ri-add-circle-line me-2"></i>Add Expense
                        </button>
                        <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
                            <i class="ri-arrow-left-line me-1"></i>Back to Expenses
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
