<?php

namespace App\Http\Requests\API\v1\Clients;

use App\Models\Client;
use App\Helpers\Traits\Request\Searchable;
use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
{
    use Searchable;

    public function authorize(): bool
    {
        if($this->user()->isAdministrator())
        {
            return true;
        }

        return $this->user()->can('read', $this->user()->client()->get()->first());
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
