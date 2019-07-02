<?php

namespace App\Policies;

use App\User;
use App\Earning;
use Illuminate\Auth\Access\HandlesAuthorization;

class EarningPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the earning.
     *
     * @param  \App\User  $user
     * @param  \App\Earning  $earning
     * @return mixed
     */
    public function update(User $user, Earning $earning)
    {
        return $user->id == $earning->user_id && $earning->status == 0;
    }

    /**
     * Determine whether the user can delete the earning.
     *
     * @param  \App\User  $user
     * @param  \App\Earning  $earning
     * @return mixed
     */
    public function delete(User $user, Earning $earning)
    {
        return $user->id == $earning->user_id;
    }
}
