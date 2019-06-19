<?php

namespace App\Policies;

use App\User;
use App\RecurringExpense;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecurringExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the recurring expense.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringExpense  $recurringExpense
     * @return mixed
     */
    public function update(User $user, RecurringExpense $recurringExpense)
    {
        return $recurringExpense->head->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the recurring expense.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringExpense  $recurringExpense
     * @return mixed
     */
    public function delete(User $user, RecurringExpense $recurringExpense)
    {
        return $recurringExpense->head->user_id == $user->id;
    }
}
