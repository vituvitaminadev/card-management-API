<?php

namespace App\Service;

use App\Model\User;
use Hyperf\Collection\Collection;

class UserService
{

    public function list(): Collection
    {
        return User::with('cards', 'heldCards')->get();
    }
}
