<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Models\User;
use App\Pipeline\User\Auth\UserAuthState;
use App\Pipeline\User\Auth\AuthPipelineException;

class ShouldChangePasswordOnLogin
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        /** @var  $user User */
        $user = $state->getUser();

        if($user->requirePasswordChangeOnFirstLogin() && !$user->passwordChangedOnFirstLogin())
        {
            throw new AuthPipelineException('Password change required', 423);
        }

        return $next($state);
    }
}
