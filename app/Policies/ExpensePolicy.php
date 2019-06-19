<?php

namespace App\Policies;

use App\User;
use App\Expense;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function update(User $user, Expense $expense)
    {
        return $expense->head->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function delete(User $user, Expense $expense)
    {
        return $expense->head->user_id == $user->id;
    }
}
