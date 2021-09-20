<?php

namespace App\Pipeline\User\Auth\Stages;

use App\Models\User;
use App\Pipeline\User\Auth\UserAuthState;
use App\Pipeline\User\Auth\AuthPipelineException;

class FindUserByUsername
{
    public function handle(UserAuthState $state, \Closure $next)
    {
        try
        {
            $user = User::where('email', $state->getUsername())->firstOrFail();

            $state->setUser($user);
        }
        catch(\Exception $e)
        {
            throw new AuthPipelineException('Incorrect credentials', 404);
        }

        return $next($state);
    }
}
