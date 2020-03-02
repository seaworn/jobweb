<?php

namespace App\Policies;

use App\ProfessionalMembership;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionalMembershipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any professional memberships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the professional membership.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalMembership  $professionalMembership
     * @return mixed
     */
    public function view(User $user, ProfessionalMembership $professionalMembership)
    {
        return $user->hasPermissionTo('view-professional-membership') && $user->id == $professionalMembership->user_id;
    }

    /**
     * Determine whether the user can create professional memberships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-professional-membership');
    }

    /**
     * Determine whether the user can update the professional membership.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalMembership  $professionalMembership
     * @return mixed
     */
    public function update(User $user, ProfessionalMembership $professionalMembership)
    {
        return $user->hasPermissionTo('update-professional-membership') && $user->id == $professionalMembership->user_id;
    }

    /**
     * Determine whether the user can delete the professional membership.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalMembership  $professionalMembership
     * @return mixed
     */
    public function delete(User $user, ProfessionalMembership $professionalMembership)
    {
        return $user->hasPermissionTo('delete-professional-membership') && $user->id == $professionalMembership->user_id;
    }

    /**
     * Determine whether the user can restore the professional membership.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalMembership  $professionalMembership
     * @return mixed
     */
    public function restore(User $user, ProfessionalMembership $professionalMembership)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the professional membership.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalMembership  $professionalMembership
     * @return mixed
     */
    public function forceDelete(User $user, ProfessionalMembership $professionalMembership)
    {
        //
    }
}
