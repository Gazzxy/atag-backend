<?php

namespace App\Policies\v1;

use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class Properties extends BasePolicy
{
    use HandlesAuthorization;

    public function read(User $user, Client $client = null)
    {
        //if(!$this->belongsToClient($user, $client)) return false;

        if(!$this->isActive($user)) return false;

        return $this->hasPermission($user,'property:read');
    }

    public function writeAccess(User $user)
    {
        if(!$this->isActive($user)) return false;

        return $this->hasPermission($user, 'property:write');
    }

    public function deleteAccess(User $user)
    {
        if(!$this->isActive($user)) return false;

        return $this->hasPermission($user, 'property:delete');
    }
}
