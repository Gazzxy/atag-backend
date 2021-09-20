<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusesSeeder extends Seeder
{
    public function run()
    {
        collect($this->getStatuses())->map(function(array $status)
        {
            UserStatus::create($status);
        });
    }

    protected function getStatuses(): array
    {
        return [
            [
                'id' => UserStatus::S_ACTIVE,
                'title' => 'Active',
                'description' => 'Active users',
                'config' => [
                    'title' => 'active',
                    'color' => 'green',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => UserStatus::S_PENDING,
                'title' => 'Pending activation',
                'description' => 'Users that are pending activation. They cannot authenticate.',
                'config' => [
                    'title' => 'pending activation',
                    'color' => 'yellow darken-2',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => UserStatus::S_SUSPENDED,
                'title' => 'Suspended',
                'description' => 'Suspended users',
                'config' => [
                    'title' => 'suspended',
                    'color' => 'red lighten-3',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => UserStatus::S_EXPIRED,
                'title' => 'Expired',
                'description' => 'Expired users',
                'config' => [
                    'title' => 'expired',
                    'color' => 'orange lighten-4',
                    'textColor' => 'black--text'
                ]
            ]
        ];
    }
}
