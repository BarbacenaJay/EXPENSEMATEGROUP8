<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Auth::user()->incomes()->latest()->get();
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        Auth::user()->incomes()->create($validated);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);
        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        $this->authorize('update', $income);

        $validated = $request->validate([
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $income->update($validated);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }
}
