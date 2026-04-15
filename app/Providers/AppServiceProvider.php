<?php

namespace App\Providers;

use App\Models\Expense;
use App\Models\Income;
use App\Policies\ExpensePolicy;
use App\Policies\IncomePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Expense::class => ExpensePolicy::class,
        Income::class => IncomePolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
