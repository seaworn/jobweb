<?php

namespace App\Policies;

use App\User;
use App\WorkExperience;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkExperiencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any work experiences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the work experience.
     *
     * @param  \App\User  $user
     * @param  \App\WorkExperience  $workExperience
     * @return mixed
     */
    public function view(User $user, WorkExperience $workExperience)
    {
        return $user->hasPermissionTo('view-work-experience') && $user->id == $workExperience->user_id;
    }

    /**
     * Determine whether the user can create work experiences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-work-experience');
    }

    /**
     * Determine whether the user can update the work experience.
     *
     * @param  \App\User  $user
     * @param  \App\WorkExperience  $workExperience
     * @return mixed
     */
    public function update(User $user, WorkExperience $workExperience)
    {
        return $user->hasPermissionTo('update-work-experience') && $user->id == $workExperience->user_id;
    }

    /**
     * Determine whether the user can delete the work experience.
     *
     * @param  \App\User  $user
     * @param  \App\WorkExperience  $workExperience
     * @return mixed
     */
    public function delete(User $user, WorkExperience $workExperience)
    {
        return $user->hasPermissionTo('delete-work-experience') && $user->id == $workExperience->user_id;
    }

    /**
     * Determine whether the user can restore the work experience.
     *
     * @param  \App\User  $user
     * @param  \App\WorkExperience  $workExperience
     * @return mixed
     */
    public function restore(User $user, WorkExperience $workExperience)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the work experience.
     *
     * @param  \App\User  $user
     * @param  \App\WorkExperience  $workExperience
     * @return mixed
     */
    public function forceDelete(User $user, WorkExperience $workExperience)
    {
        //
    }
}
