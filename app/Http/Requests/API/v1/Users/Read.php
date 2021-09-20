<?php

namespace App\Http\Requests\API\v1\Users;

use App\Models\User;
use App\Helpers\Traits\Request\Searchable;
use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
{
    use Searchable;

    public function authorize()
    {
        $id = $this->route('id');

        if(empty($id))
        {
            return true;
        }

        /** @var  $user User */
        $user = $this->user();

        if($user->isAdministrator()) return true;

        $model = User::findOrFail($id);

        return (int)$model->client_id === (int)$user->client_id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
