<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\Permission;
use App\Models\User2Permission;
use Illuminate\Support\Facades\DB;

class UpdatePermissions
{
    protected array $response;

    public function execute(array $permissions, int $user_id): self
    {
        $result = DB::transaction(function() use ($permissions, $user_id)
        {
            // Remove all the permissions user had
            User2Permission::where('user_id', $user_id)->delete();

            // Insert the new set of permissions
            foreach($permissions as $permission)
            {
                if(isset($permission['id']))
                {
                    User2Permission::create([
                        'user_id' => $user_id,
                        'permission_id' => $permission['id']
                    ]);
                }
            }

            if($this->hasManagingAccountPermission($permissions))
            {
                $model = User::findOrFail($user_id);

                $model->setAsManagingAccount();
            }

            return true;
        });

        $this->response = ['result' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }

    protected function hasManagingAccountPermission(array $permissions): bool
    {
        $has = false;

        foreach($permissions as $permission)
        {
            if($permission['id'] === Permission::T_MANAGING_ACCOUNT)
            {
                $has = true;

                break;
            }
        }

        return $has;
    }
}
