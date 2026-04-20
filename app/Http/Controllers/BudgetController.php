<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Auth::user()->budgets;
        return view('budgets.index', compact('budgets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        Auth::user()->budgets()->updateOrCreate(
            ['category' => $request->category],
            ['amount' => $request->amount, 'period' => 'monthly']
        );

        return redirect()->route('budgets.index')->with('success', 'Budget saved!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget deleted!');
    }
}