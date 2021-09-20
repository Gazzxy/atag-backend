<?php

namespace App\Http\Requests\API\v1\Properties;

use App\Models\User;
use App\Models\Property;
use App\Helpers\Traits\Request\Searchable;
use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
{
    use Searchable;

    public function authorize(): bool
    {
        $id = $this->route('id');

        if(empty($id)) return true;

        /** @var  $user User */
        $user = $this->user();

        if($user->isAdministrator()) return true;

        $property = Property::findOrFail($id);

        return (int)$property->client_id === (int)$user->client_id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
