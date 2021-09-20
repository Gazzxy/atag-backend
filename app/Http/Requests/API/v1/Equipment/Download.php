<?php

namespace App\Http\Requests\API\v1\Equipment;

use App\Models\EquipmentReportView;
use Illuminate\Foundation\Http\FormRequest;

class Download extends FormRequest
{
    public function authorize(): bool
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

        $model = EquipmentReportView::findOrFail($id);

        return (int)$model->client_id === (int)$this->user()->client_id;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
