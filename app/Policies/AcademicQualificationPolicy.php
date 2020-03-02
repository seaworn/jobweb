<?php

namespace App\Policies;

use App\AcademicQualification;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicQualificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any academic qualifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the academic qualification.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicQualification  $academicQualification
     * @return mixed
     */
    public function view(User $user, AcademicQualification $academicQualification)
    {
        return $user->hasPermissionTo('view-academic-qualification') && $user->id == $academicQualification->user_id;
    }

    /**
     * Determine whether the user can create academic qualifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create-academic-qualification');
    }

    /**
     * Determine whether the user can update the academic qualification.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicQualification  $academicQualification
     * @return mixed
     */
    public function update(User $user, AcademicQualification $academicQualification)
    {
        return $user->hasPermissionTo('update-academic-qualification') && $user->id == $academicQualification->user_id;
    }

    /**
     * Determine whether the user can delete the academic qualification.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicQualification  $academicQualification
     * @return mixed
     */
    public function delete(User $user, AcademicQualification $academicQualification)
    {
        return $user->hasPermissionTo('delete-academic-qualification') && $user->id == $academicQualification->user_id;
    }

    /**
     * Determine whether the user can restore the academic qualification.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicQualification  $academicQualification
     * @return mixed
     */
    public function restore(User $user, AcademicQualification $academicQualification)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the academic qualification.
     *
     * @param  \App\User  $user
     * @param  \App\AcademicQualification  $academicQualification
     * @return mixed
     */
    public function forceDelete(User $user, AcademicQualification $academicQualification)
    {
        //
    }
}
