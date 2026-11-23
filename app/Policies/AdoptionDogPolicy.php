<?php

namespace App\Policies;

use App\Models\AdoptionDog;
use App\Models\User;

class AdoptionDogPolicy
{
    public function update(User $user, AdoptionDog $dog): bool
    {
        return $user->isAdmin() || $dog->user_id === $user->id;
    }

    public function delete(User $user, AdoptionDog $dog): bool
    {
        return $this->update($user, $dog);
    }
}