<?php

namespace App\Pipeline\User\Auth;

use App\Models\User;
use Illuminate\Pipeline\Pipeline;
use App\Pipeline\User\Auth\Stages\VerifyStatus;
use App\Pipeline\User\Auth\Stages\VerifyPassword;
use App\Pipeline\User\Auth\Stages\UpdateLastLoginAt;
use App\Pipeline\User\Auth\Stages\FindUserByUsername;
use App\Pipeline\User\Auth\Stages\VerifyClientStatus;
use App\Pipeline\User\Auth\Stages\ShouldChangePasswordOnLogin;

class UserAuthPipeline
{
    protected Pipeline $pipeline;
    protected UserAuthState $state;
    protected array $stages;

    public function __construct(string $username, string $password)
    {
        $this->pipeline = app(Pipeline::class);

        $this->state = new UserAuthState($username, $password);

        $this->stages = [
            FindUserByUsername::class,
            VerifyStatus::class,
            VerifyClientStatus::class,
            VerifyPassword::class,
            ShouldChangePasswordOnLogin::class,
            UpdateLastLoginAt::class
        ];
    }

    public function run(): User
    {
        return $this->pipeline->send($this->state)->through($this->stages)->then(function(UserAuthState $state)
        {
            return $state->getUser();
        });
    }
}
