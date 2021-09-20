<?php

namespace App\Events;

use App\Models\Client;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ClientCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
