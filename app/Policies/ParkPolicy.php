<?php

namespace App\Policies;

use App\Models\Park;
use App\Models\User;

class ParkPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Park $park): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Park $park): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Park $park): bool
    {
        return $user->isAdmin();
    }
}
