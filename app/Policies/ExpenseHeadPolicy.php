<?php

namespace App\Policies;

use App\User;
use App\ExpenseHead;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpenseHeadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseHead  $expenseHead
     * @return mixed
     */
    public function update(User $user, ExpenseHead $expenseHead)
    {
        return $user->id == $expenseHead->user_id;
    }

    /**
     * Determine whether the user can delete the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseHead  $expenseHead
     * @return mixed
     */
    public function delete(User $user, ExpenseHead $expenseHead)
    {
        return $user->id == $expenseHead->user_id;
    }
}
