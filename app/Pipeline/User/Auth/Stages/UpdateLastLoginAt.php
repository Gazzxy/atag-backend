<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Pipeline\User\Auth\UserAuthState;

class UpdateLastLoginAt
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        $state->getUser()->markLoggedIn();

        return $next($state);
    }
}
