<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $auth, User $target): bool
    {
        return $auth->id === $target->id;
    }
}
