<?php

namespace App\Http\Actions\v1\UI;

use App\Models\User;

class GetNavigation
{
    protected array $response;

    public function execute(User $user): self
    {
        $menu = [];

        if($user->isAdministrator())
        {
            $menu = $this->getAdminMenu();
        }

        if($user->isManagingAccount())
        {
            $menu = $this->getManagingMenu();
        }

        if($user->isUserAccount())
        {
            $menu = $this->getUserMenu();
        }


//        if($user->isAdministrator())
//        {
//            $menu[] = [
//                'icon' => 'mdi-apps',
//                'title' => 'Dashboard',
//                'subtitle' => 'Quick Info',
//                'url' => '/dashboard'
//            ];
//        }
//
//        if($user->hasPermission('client:read') || $user->isAdministrator())
//        {
//            $menu[] = [
//                'icon' => 'mdi-account-supervisor-circle',
//                'title' => 'Clients',
//                'subtitle' => 'Find and manage clients',
//                'url' => '/clients'
//            ];
//        }
//
//        if($user->hasPermission('user:read') || $user->isAdministrator())
//        {
//            $menu[] = [
//                'icon' => 'mdi-account-box-outline',
//                'title' => 'Users',
//                'subtitle' => 'Find and manage users',
//                'url' => '/users'
//            ];
//        }
//
//        if($user->hasPermission('property:read') || $user->isAdministrator())
//        {
//            $menu[] = [
//                'icon' => 'mdi-map-marker',
//                'title' => 'Properties',
//                'subtitle' => 'Manage properties',
//                'url' => '/properties'
//            ];
//        }
//
//        if($user->hasPermission('equipment:read') || $user->isAdministrator())
//        {
//            $menu[] = [
//                'icon' => 'mdi-folder-open',
//                'title' => 'Equipment Inventory',
//                'subtitle' => 'Manage Equipment Inventory',
//                'url' => '/equipment'
//            ];
//        }

        $this->response = $menu;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }

    protected function getAdminMenu(): array
    {
        return [
            [
                'icon' => 'mdi-apps',
                'title' => 'Dashboard',
                'subtitle' => 'Quick Info',
                'url' => '/dashboard'
            ],

            [
                'icon' => 'mdi-account-supervisor-circle',
                'title' => 'Clients',
                'subtitle' => 'Find and manage clients',
                'url' => '/clients'
            ],

            [
                'icon' => 'mdi-account-box-outline',
                'title' => 'Users',
                'subtitle' => 'Find and manage users',
                'url' => '/users'
            ],

            [
                'icon' => 'mdi-map-marker',
                'title' => 'Properties',
                'subtitle' => 'Manage properties',
                'url' => '/properties'
            ],

            [
                'icon' => 'mdi-folder-open',
                'title' => 'Equipment Inventory',
                'subtitle' => 'Manage Equipment Inventory',
                'url' => '/equipment'
            ]
        ];
    }

    protected function getManagingMenu(): array
    {
        return [

            [
                'icon' => 'mdi-account-box-outline',
                'title' => 'Users',
                'subtitle' => 'Find and manage users',
                'url' => '/users'
            ],

            [
                'icon' => 'mdi-map-marker',
                'title' => 'Properties',
                'subtitle' => 'Manage properties',
                'url' => '/properties'
            ],

            [
                'icon' => 'mdi-folder-open',
                'title' => 'Equipment Inventory',
                'subtitle' => 'Manage Equipment Inventory',
                'url' => '/equipment'
            ]
        ];
    }

    protected function getUserMenu(): array
    {
        return [

            [
                'icon' => 'mdi-map-marker',
                'title' => 'Properties',
                'subtitle' => 'Manage properties',
                'url' => '/properties'
            ],

            [
                'icon' => 'mdi-folder-open',
                'title' => 'Equipment Inventory',
                'subtitle' => 'Manage Equipment Inventory',
                'url' => '/equipment'
            ]
        ];
    }
}
