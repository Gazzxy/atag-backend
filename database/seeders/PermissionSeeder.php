<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        collect($this->getPermissions())->map(function(array $permission)
        {
            Permission::create($permission);
        });
    }

    protected function getPermissions()
    {
        return [
            [
                'permission' => 'managing:account',
                'description' => 'Managing account. Has all permissions'
            ],
            [
                'permission' => 'client:read',
                'description' => 'Read info about the client'
            ],

            [
                'permission' => 'client:write',
                'description' => 'Create / update client records'
            ],

            [
                'permission' => 'client:delete',
                'description' => 'Delete client records'
            ],

            [
                'permission' => 'user:read',
                'description' => 'Read info about the users that belong to a client'
            ],

            [
                'permission' => 'user:write',
                'description' => 'Create / update user accounts belonging to the client'
            ],

            [
                'permission' => 'user:delete',
                'description' => 'Delete user records belonging to the client'
            ],

            [
                'permission' => 'property:read',
                'description' => 'Read info about properties that belong to the client'
            ],

            [
                'permission' => 'property:write',
                'description' => 'Create / update property records belonging to the client'
            ],

            [
                'permission' => 'property:delete',
                'description' => 'Delete property records belonging to the client'
            ],

            [
                'permission' => 'equipment:read',
                'description' => 'Read info about equipment that belong to the client'
            ],

            [
                'permission' => 'equipment:write',
                'description' => 'Create / update equipment records belonging to the client'
            ],

            [
                'permission' => 'equipment:delete',
                'description' => 'Delete equipment records belonging to the client'
            ],
        ];
    }
}
