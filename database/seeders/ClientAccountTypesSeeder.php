<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientAccountType;

class ClientAccountTypesSeeder extends Seeder
{
    public function run()
    {
        collect($this->getAccountTypes())->map(function(array $type)
        {
            ClientAccountType::create($type);
        });
    }

    protected function getAccountTypes(): array
    {
        return [
            [
                'id' => ClientAccountType::T_MANAGING_ACCOUNT,
                'title' => 'Managing Account',
                'description' => 'Account that manages the entire client/organization',
                'config' => [
                    'title' => 'managing account',
                    'color' => 'green',
                    'textColor' => 'white--text'
                ]
            ],

            [
                'id' => ClientAccountType::T_USER_ACCOUNT,
                'title' => 'User Account',
                'description' => 'Account that belongs to the organization',
                'config' => [
                    'title' => 'user account',
                    'color' => 'grey lighten-3',
                    'textColor' => 'black--text'
                ]
            ]
        ];
    }
}
