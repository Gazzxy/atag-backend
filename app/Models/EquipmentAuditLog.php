<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentAuditLog extends Model
{
    protected $table = 'equipment_audit_log';

    public $timestamps = true;

    protected $fillable = [
        'equipment_id',
        'summary',
        'trace',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'trace' => 'array'
    ];
}
