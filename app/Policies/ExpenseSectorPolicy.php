<?php

namespace App\Policies;

use App\User;
use App\ExpenseSector;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpenseSectorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseSector  $expenseSector
     * @return mixed
     */
    public function update(User $user, ExpenseSector $expenseSector)
    {
        return $user->id == $expenseSector->user_id;
    }

    /**
     * Determine whether the user can delete the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseSector  $expenseSector
     * @return mixed
     */
    public function delete(User $user, ExpenseSector $expenseSector)
    {
        return $user->id == $expenseSector->user_id;
    }
}
