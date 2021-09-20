<?php

namespace App\Policies\v1;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

abstract class BasePolicy
{
    public function before(User $user)
    {
        if($user->isAdministrator())
        {
            return $user->isAdministrator();
        }
    }

    /**
     * @param User $user
     * @param Client $client
     * @return bool
     */
    protected function belongsToClient(User $user, Client $client): bool
    {
        $result = $user->client_id === $client->id;

        if(!$result)
        {
            Log::channel('authorization')->warning('Access denied', [
                'message' => 'Client ID mismatch',
                'user_id' => $user->id,
                'name' => $user->getFullName(),
                'user_client_id' => $user->client_id,
                'client_id' => $client->id
            ]);
        }

        return $result;
    }

    /**
     * @param User $user
     * @return bool
     */
    protected function isActive(User $user): bool
    {
        // Disallow inactive users
        if(!$user->isActive())
        {
            Log::channel('authorization')->warning('Access denied', [
                'message' => 'User is inactive',
                'user_id' => $user->id,
                'name' => $user->getFullName()
            ]);
        }

        return (bool)$user->isActive();
    }

    /**
     * @param User $user
     * @param string $permission
     * @return bool
     */
    protected function hasPermission(User $user, string $permission): bool
    {
        $result = $user->hasPermission($permission);

        if(!$result)
        {
            Log::channel('authorization')->warning('Access denied', [
                'message' => 'User does not have permission: '. $permission,
                'user_id' => $user->id,
                'name' => $user->getFullName()
            ]);
        }

        return $result;
    }
}
