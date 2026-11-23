<?php

namespace App\Policies;

use App\Models\Dog;
use App\Models\User;

class DogPolicy
{
    public function manage(User $user, Dog $dog): bool
    {
        return $user->isAdmin() || $dog->user_id === $user->id;
    }

    public function view(User $user, Dog $dog): bool   { return $this->manage($user, $dog); }
    public function update(User $user, Dog $dog): bool { return $this->manage($user, $dog); }
    public function delete(User $user, Dog $dog): bool { return $this->manage($user, $dog); }
}