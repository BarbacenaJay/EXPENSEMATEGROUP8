<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalIncome = $user->incomes()->sum('amount');
        $totalExpense = $user->expenses()->sum('amount');
        $balance = $totalIncome - $totalExpense;
        
        $recentExpenses = $user->expenses()->latest()->take(5)->get();
        $recentIncomes = $user->incomes()->latest()->take(5)->get();
        
        return view('dashboard', compact('totalIncome', 'totalExpense', 'balance', 'recentExpenses', 'recentIncomes'));
    }
}
