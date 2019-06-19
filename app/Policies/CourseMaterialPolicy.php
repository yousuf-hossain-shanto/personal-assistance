<?php

namespace App\Policies;

use App\User;
use App\CourseMaterial;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseMaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course material.
     *
     * @param  \App\User  $user
     * @param  \App\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function view(User $user, CourseMaterial $courseMaterial)
    {
        return $user->id == $courseMaterial->user_id || in_array($user->id, $courseMaterial->shared);
    }

    /**
     * Determine whether the user can update the course material.
     *
     * @param  \App\User  $user
     * @param  \App\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function update(User $user, CourseMaterial $courseMaterial)
    {
        return $user->id == $courseMaterial->user_id;
    }

    /**
     * Determine whether the user can delete the course material.
     *
     * @param  \App\User  $user
     * @param  \App\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function delete(User $user, CourseMaterial $courseMaterial)
    {
        return $user->id == $courseMaterial->user_id;
    }
}
