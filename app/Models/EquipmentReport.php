<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentReport extends Model
{
    use SoftDeletes;

    protected $table = 'equipment_reports';

    public $timestamps = true;

    protected $fillable = [
        'equipment_id',
        'user_id',
        'title',
        'url',
        'filename',
        'filepath',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function softDelete(): bool
    {
        $this->deleted_at = now();

        return $this->save();
    }
}
