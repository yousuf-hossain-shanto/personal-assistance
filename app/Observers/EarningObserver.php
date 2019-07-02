<?php

namespace App\Observers;

use App\Earning;

class EarningObserver
{
    /**
     * Handle the earning "created" event.
     *
     * @param  \App\Earning $earning
     * @return void
     */
    public function created(Earning $earning)
    {
        //
    }

    /**
     * Handle the earning "updated" event.
     *
     * @param  \App\Earning $earning
     * @return void
     */
    public function updated(Earning $earning)
    {
        if ($earning->status == 1 && $earning->wallet) {
            $wallet = $earning->wallet;
            $wallet->update([
                'balance' => ($wallet->balance + $earning->amount)
            ]);
        }
    }

    /**
     * Handle the earning "deleted" event.
     *
     * @param  \App\Earning $earning
     * @return void
     */
    public function deleted(Earning $earning)
    {
        if ($earning->status == 1 && $earning->wallet) {
            $wallet = $earning->wallet;
            $wallet->update([
                'balance' => ($wallet->balance - $earning->amount)
            ]);
        }
    }

    /**
     * Handle the earning "restored" event.
     *
     * @param  \App\Earning $earning
     * @return void
     */
    public function restored(Earning $earning)
    {
        //
    }

    /**
     * Handle the earning "force deleted" event.
     *
     * @param  \App\Earning $earning
     * @return void
     */
    public function forceDeleted(Earning $earning)
    {
        //
    }
}
