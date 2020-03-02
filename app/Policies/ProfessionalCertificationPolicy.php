<?php

namespace App\Policies;

use App\ProfessionalCertification;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionalCertificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any professional certifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the professional certification.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalCertification  $professionalCertification
     * @return mixed
     */
    public function view(User $user, ProfessionalCertification $professionalCertification)
    {
        return $user->hasPermissionTo('view-professional-certification') && $user->id == $professionalCertification->user_id;
    }

    /**
     * Determine whether the user can create professional certifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-professional-certification');
    }

    /**
     * Determine whether the user can update the professional certification.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalCertification  $professionalCertification
     * @return mixed
     */
    public function update(User $user, ProfessionalCertification $professionalCertification)
    {
        return $user->hasPermissionTo('update-professional-certification') && $user->id == $professionalCertification->user_id;
    }

    /**
     * Determine whether the user can delete the professional certification.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalCertification  $professionalCertification
     * @return mixed
     */
    public function delete(User $user, ProfessionalCertification $professionalCertification)
    {
        return $user->hasPermissionTo('delete-professional-certification') && $user->id == $professionalCertification->user_id;
    }

    /**
     * Determine whether the user can restore the professional certification.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalCertification  $professionalCertification
     * @return mixed
     */
    public function restore(User $user, ProfessionalCertification $professionalCertification)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the professional certification.
     *
     * @param  \App\User  $user
     * @param  \App\ProfessionalCertification  $professionalCertification
     * @return mixed
     */
    public function forceDelete(User $user, ProfessionalCertification $professionalCertification)
    {
        //
    }
}
