<?php

namespace App\Policies;

use App\Models\Traveler;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class TravelerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('travel.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Traveler $traveler): bool
    {
        return Gate::allows('travel.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('travel.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Traveler $traveler): bool
    {
        return Gate::allows('travel.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Traveler $traveler): bool
    {
        return Gate::allows('travel.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Traveler $traveler): bool
    {
        return Gate::allows('travel.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Traveler $traveler): bool
    {
        return Gate::allows('travel.forceDelete');
    }
}
