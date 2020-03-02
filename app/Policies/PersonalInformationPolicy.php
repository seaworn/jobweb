<?php

namespace App\Policies;

use App\PersonalInformation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalInformationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any personal information.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the personal information.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalInformation  $personalInformation
     * @return mixed
     */
    public function view(User $user, PersonalInformation $personalInformation)
    {
        return $user->hasPermissionTo('view-personal-information') && $user->id == $personalInformation->user_id;
    }

    /**
     * Determine whether the user can create personal information.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-personal-information');
    }

    /**
     * Determine whether the user can update the personal information.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalInformation  $personalInformation
     * @return mixed
     */
    public function update(User $user, PersonalInformation $personalInformation)
    {
        return $user->hasPermissionTo('update-personal-information') && $user->id == $personalInformation->user_id;
    }

    /**
     * Determine whether the user can delete the personal information.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalInformation  $personalInformation
     * @return mixed
     */
    public function delete(User $user, PersonalInformation $personalInformation)
    {
        return $user->hasPermissionTo('delete-personal-information') && $user->id == $personalInformation->user_id;
    }

    /**
     * Determine whether the user can restore the personal information.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalInformation  $personalInformation
     * @return mixed
     */
    public function restore(User $user, PersonalInformation $personalInformation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the personal information.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalInformation  $personalInformation
     * @return mixed
     */
    public function forceDelete(User $user, PersonalInformation $personalInformation)
    {
        //
    }
}