<?php

namespace App\Policies;

use App\Models\Guestbook;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuestbookPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Guestbook $guestbook)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return \Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Guestbook $guestbook)
    {
        return $guestbook->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Guestbook $guestbook)
    {
        return $guestbook->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Guestbook $guestbook)
    {
        return $guestbook->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Guestbook $guestbook)
    {
        return $guestbook->user_id === $user->id;
    }
}
