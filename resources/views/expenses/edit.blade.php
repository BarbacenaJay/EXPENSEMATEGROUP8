@extends('layouts.app')

@section('content')
<h1 class="page-title">
    <i class="ri-edit-line"></i>
    Edit Expense
</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="ri-shopping-cart-line me-2"></i>Update Expense
            </div>
            <div class="card-body">
                <form action="{{ route('expenses.update', $expense) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="ri-file-text-line me-1"></i>Title
                        </label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $expense->title) }}" required>
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
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount', $expense->amount) }}" required>
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
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ $expense->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">
                            <i class="ri-calendar-line me-1"></i>Date
                        </label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning btn-lg text-white">
                            <i class="ri-save-line me-2"></i>Update Expense
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
