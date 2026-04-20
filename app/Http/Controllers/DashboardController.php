<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        
        $expensesByCategory = $user->expenses()
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();
        
        $months = [];
        $monthlyIncome = [];
        $monthlyExpense = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $monthlyIncome[] = $user->incomes()
                ->whereMonth('date', $date->month)
                ->whereYear('date', $date->year)
                ->sum('amount');
                
            $monthlyExpense[] = $user->expenses()
                ->whereMonth('date', $date->month)
                ->whereYear('date', $date->year)
                ->sum('amount');
        }
        
        $weekLabels = [];
        $weeklySpending = [];
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weekLabels[] = 'Week ' . (4 - $i);
            
            $weeklySpending[] = $user->expenses()
                ->whereBetween('date', [$startOfWeek, $endOfWeek])
                ->sum('amount');
        }
        
        $budgets = $user->budgets;
        $budgetWarnings = [];
        foreach ($budgets as $budget) {
            $spent = $user->expenses()
                ->where('category', $budget->category)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->sum('amount');
            
            $percent = $budget->amount > 0 ? ($spent / $budget->amount) * 100 : 0;
            
            if ($percent >= 100) {
                $budgetWarnings[] = [
                    'category' => $budget->category,
                    'spent' => $spent,
                    'budget' => $budget->amount,
                    'status' => 'exceeded'
                ];
            } elseif ($percent >= 80) {
                $budgetWarnings[] = [
                    'category' => $budget->category,
                    'spent' => $spent,
                    'budget' => $budget->amount,
                    'status' => 'near_limit'
                ];
            }
        }
        
        return view('dashboard', compact(
            'totalIncome', 'totalExpense', 'balance', 
            'recentExpenses', 'recentIncomes',
            'expensesByCategory',
            'months', 'monthlyIncome', 'monthlyExpense',
            'weekLabels', 'weeklySpending',
            'budgetWarnings'
        ));
    }
}