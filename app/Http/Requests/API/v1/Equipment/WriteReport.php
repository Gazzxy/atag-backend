<?php

namespace App\Http\Requests\API\v1\Equipment;

use App\DTO\EquipmentReportDTO;
use Illuminate\Foundation\Http\FormRequest;

class WriteReport extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipment_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'filename' => 'required',
            'file_contents' => 'required'
        ];
    }

    public function getModelDTO(): EquipmentReportDTO
    {
        return new EquipmentReportDTO([
            'equipment_id' => (int)$this->input('equipment_id'),
            'user_id' => (int)$this->user()->id,
            'title' => $this->input('title'),
            'filename' => $this->input('filename'),
            'file_contents' => $this->input('file_contents'),
        ]);
    }
}
