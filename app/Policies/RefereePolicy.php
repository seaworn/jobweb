<?php

namespace App\Policies;

use App\Referee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RefereePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any referees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the referee.
     *
     * @param  \App\User  $user
     * @param  \App\Referee  $referee
     * @return mixed
     */
    public function view(User $user, Referee $referee)
    {
        return $user->hasPermissionTo('view-referee') && $user->id == $referee->user_id;
    }

    /**
     * Determine whether the user can create referees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('view-referee');
    }

    /**
     * Determine whether the user can update the referee.
     *
     * @param  \App\User  $user
     * @param  \App\Referee  $referee
     * @return mixed
     */
    public function update(User $user, Referee $referee)
    {
        return $user->hasPermissionTo('update-referee') && $user->id == $referee->user_id;
    }

    /**
     * Determine whether the user can delete the referee.
     *
     * @param  \App\User  $user
     * @param  \App\Referee  $referee
     * @return mixed
     */
    public function delete(User $user, Referee $referee)
    {
        return $user->hasPermissionTo('delete-referee') && $user->id == $referee->user_id;
    }

    /**
     * Determine whether the user can restore the referee.
     *
     * @param  \App\User  $user
     * @param  \App\Referee  $referee
     * @return mixed
     */
    public function restore(User $user, Referee $referee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the referee.
     *
     * @param  \App\User  $user
     * @param  \App\Referee  $referee
     * @return mixed
     */
    public function forceDelete(User $user, Referee $referee)
    {
        //
    }
}
