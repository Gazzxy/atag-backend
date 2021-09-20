<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AccountCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected User $account;
    protected int $type_id;
    protected string $password;

    public function __construct(User $account, int $type_id, string $password)
    {
        $this->account = $account;
        $this->type_id = $type_id;
        $this->password = $password;
    }
}
