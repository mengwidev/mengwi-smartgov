<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PersonalAccessToken;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalAccessTokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_personal::access::token');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('view_personal::access::token');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_personal::access::token');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('update_personal::access::token');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('delete_personal::access::token');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_personal::access::token');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('force_delete_personal::access::token');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_personal::access::token');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('restore_personal::access::token');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_personal::access::token');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, PersonalAccessToken $personalAccessToken): bool
    {
        return $user->can('replicate_personal::access::token');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_personal::access::token');
    }
}
