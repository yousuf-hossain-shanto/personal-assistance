<?php

namespace App\Providers;

use App\Earning;
use App\Expense;
use App\Observers\EarningObserver;
use App\Observers\ExpenseObserver;
use App\Observers\TransferObserver;
use App\Transfer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Earning::observe(EarningObserver::class);
        Expense::observe(ExpenseObserver::class);
        Transfer::observe(TransferObserver::class);
    }
}
