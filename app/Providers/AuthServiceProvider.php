<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\EarningSource' => 'App\Policies\EarningSourcePolicy',
         'App\ExpenseSector' => 'App\Policies\ExpenseSectorPolicy',

         'App\ExpenseHead' => 'App\Policies\ExpenseHeadPolicy',
         'App\RecurringExpense' => 'App\Policies\RecurringExpensePolicy',
         'App\Expense' => 'App\Policies\ExpensePolicy',

         'App\Wallet' => 'App\Policies\WalletPolicy',
         'App\Earning' => 'App\Policies\EarningPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
