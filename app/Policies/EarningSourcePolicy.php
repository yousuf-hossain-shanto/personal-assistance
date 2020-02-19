<?php

namespace App\Policies;

use App\User;
use App\EarningSource;
use Illuminate\Auth\Access\HandlesAuthorization;

class EarningSourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\EarningSource  $earningSource
     * @return mixed
     */
    public function update(User $user, EarningSource $earningSource)
    {
        return $user->id == $earningSource->user_id;
    }

    /**
     * Determine whether the user can delete the expense head.
     *
     * @param  \App\User  $user
     * @param  \App\EarningSource  $earningSource
     * @return mixed
     */
    public function delete(User $user, EarningSource $earningSource)
    {
        return $user->id == $earningSource->user_id;
    }
}
