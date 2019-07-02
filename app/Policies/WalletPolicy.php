<?php

namespace App\Policies;

use App\User;
use App\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the wallet.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return mixed
     */
    public function update(User $user, Wallet $wallet)
    {
        return $user->id == $wallet->user_id;
    }

    /**
     * Determine whether the user can delete the wallet.
     *
     * @param  \App\User  $user
     * @param  \App\Wallet  $wallet
     * @return mixed
     */
    public function delete(User $user, Wallet $wallet)
    {
        return $user->id == $wallet->user_id;
    }
}
