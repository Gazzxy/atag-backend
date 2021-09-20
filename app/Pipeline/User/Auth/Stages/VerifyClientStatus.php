<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Models\ClientStatus;
use App\Pipeline\User\Auth\UserAuthState;
use App\Pipeline\User\Auth\AuthPipelineException;

class VerifyClientStatus
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        $client = $state->getUser()->client;

        // If there is no client associated with the user, we are dealing with an admin account so we can abort this stage
        if(empty($client))
        {
            return $next($state);
        }

        $status_id = (int)$client->status_id;

        if(ClientStatus::S_PENDING === $status_id)
        {
            throw new AuthPipelineException('Parent organization is pending activation', 422);
        }

        if(ClientStatus::S_SUSPENDED === $status_id)
        {
            throw new AuthPipelineException('Parent organization suspended', 422);
        }

        if(ClientStatus::S_EXPIRED === $status_id)
        {
            throw new AuthPipelineException('Parent organization expired', 422);
        }

        return $next($state);
    }
}
