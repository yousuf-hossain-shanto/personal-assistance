<?php

namespace App\Observers;

use App\Expense;

class ExpenseObserver
{
    /**
     * Handle the expense "created" event.
     *
     * @param  \App\Expense $expense
     * @return void
     */
    public function created(Expense $expense)
    {
        //
    }

    /**
     * Handle the expense "updated" event.
     *
     * @param  \App\Expense $expense
     * @return void
     */
    public function updated(Expense $expense)
    {
        if ($expense->status == 1 && $expense->wallet) {
            $wallet = $expense->wallet;
            $wallet->update([
                'balance' => ($wallet->balance - $expense->amount)
            ]);
        }
    }

    /**
     * Handle the expense "deleted" event.
     *
     * @param  \App\Expense $expense
     * @return void
     */
    public function deleted(Expense $expense)
    {
        if ($expense->status == 1 && $expense->wallet) {
            $wallet = $expense->wallet;
            $wallet->update([
                'balance' => ($wallet->balance + $expense->amount)
            ]);
        }
    }

    /**
     * Handle the expense "restored" event.
     *
     * @param  \App\Expense $expense
     * @return void
     */
    public function restored(Expense $expense)
    {
        //
    }

    /**
     * Handle the expense "force deleted" event.
     *
     * @param  \App\Expense $expense
     * @return void
     */
    public function forceDeleted(Expense $expense)
    {
        //
    }
}
