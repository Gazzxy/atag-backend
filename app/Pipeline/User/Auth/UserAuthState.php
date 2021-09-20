<?php

namespace App\Pipeline\User\Auth;

use App\Models\User;

class UserAuthState
{
    protected string $username;
    protected string $password;
    protected User $user;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getResponse()
    {

    }
}
