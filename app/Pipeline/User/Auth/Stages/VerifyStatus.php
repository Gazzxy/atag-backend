<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Models\UserStatus;
use App\Pipeline\User\Auth\UserAuthState;
use App\Pipeline\User\Auth\AuthPipelineException;

class VerifyStatus
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        $user = $state->getUser();

        $status_id = (int)$user->status_id;

        if(UserStatus::S_PENDING === $status_id)
        {
            throw new AuthPipelineException('Account is pending activation', 422);
        }

        if(UserStatus::S_SUSPENDED === $status_id)
        {
            throw new AuthPipelineException('Account is suspended', 422);
        }

        if(UserStatus::S_EXPIRED === $status_id)
        {
            throw new AuthPipelineException('Account is expired', 422);
        }

        return $next($state);
    }
}
