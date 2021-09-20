<?php

namespace App\Http\Actions\v1\Users;

use App\Pipeline\User\Auth\UserAuthPipeline;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Auth
{
    protected string $message;
    protected int $status;
    protected array $response;

    public function execute(string $username, string $password): self
    {
        $pipeline = new UserAuthPipeline($username, $password);

        $user = $pipeline->run();

        AuthFacade::login($user, true);

        $this->response = ['status' => 'success'];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
