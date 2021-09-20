<?php

namespace Database\Seeders;

use App\Models\ClientStatus;
use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    public function run()
    {
        collect($this->getStatuses())->map(function(array $status)
        {
            ClientStatus::create($status);
        });
    }

    protected function getStatuses(): array
    {
        return [
            [
                'id' => ClientStatus::S_ACTIVE,
                'title' => 'Active',
                'description' => 'Active clients that can use the system fully',
                'config' => [
                    'title' => 'active',
                    'color' => 'green',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => ClientStatus::S_PENDING,
                'title' => 'Pending activation',
                'description' => 'Clients that are pending activation. These clients cannot use the system until activated',
                'config' => [
                    'title' => 'pending activation',
                    'color' => 'yellow darken-2',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => ClientStatus::S_SUSPENDED,
                'title' => 'Suspended',
                'description' => 'Suspended clients cannot access the system and any users belonging to them are suspended also',
                'config' => [
                    'title' => 'suspended',
                    'color' => 'red lighten-3',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => ClientStatus::S_EXPIRED,
                'title' => 'Expired',
                'description' => 'Expired clients are clients whose subscription ended',
                'config' => [
                    'title' => 'expired',
                    'color' => 'orange lighten-4',
                    'textColor' => 'black--text'
                ]
            ]
        ];
    }
}
