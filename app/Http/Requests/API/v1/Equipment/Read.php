<?php

namespace App\Http\Requests\API\v1\Equipment;

use App\Models\EquipmentView;
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

        if($this->user()->isAdministrator())
        {
            return true;
        }

        $model = EquipmentView::findOrFail($id);

        return (int)$model->client_id === (int)$this->user()->client_id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
