<?php

namespace App\Observers;

use App\Transfer;
use App\Wallet;

class TransferObserver
{
    /**
     * Handle the transfer "created" event.
     *
     * @param  \App\Transfer  $transfer
     * @return void
     */
    public function created(Transfer $transfer)
    {
        /** @var Wallet $from */
        $from = $transfer->from;
        /** @var Wallet $to */
        $to = $transfer->to;

        $from->update([
            'balance' => ($from->balance-$transfer->amount)
        ]);

        $to->update([
            'balance' => ($to->balance+$transfer->amount)
        ]);

    }

    /**
     * Handle the transfer "updated" event.
     *
     * @param  \App\Transfer  $transfer
     * @return void
     */
    public function updated(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the transfer "deleted" event.
     *
     * @param  \App\Transfer  $transfer
     * @return void
     */
    public function deleted(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the transfer "restored" event.
     *
     * @param  \App\Transfer  $transfer
     * @return void
     */
    public function restored(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the transfer "force deleted" event.
     *
     * @param  \App\Transfer  $transfer
     * @return void
     */
    public function forceDeleted(Transfer $transfer)
    {
        //
    }
}
