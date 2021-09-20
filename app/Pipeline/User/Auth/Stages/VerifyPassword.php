<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Pipeline\User\Auth\UserAuthState;
use App\Pipeline\User\Auth\AuthPipelineException;

class VerifyPassword
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        $result = password_verify($state->getPassword(), $state->getUser()->password);

        if(!$result)
        {
            throw new AuthPipelineException('Incorrect credentials: ' . $state->getPassword(), 422);
        }

        return $next($state);
    }
}
