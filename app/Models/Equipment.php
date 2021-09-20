<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'equipment';

    public $timestams = true;

    protected $fillable = [
        'public_id',
        'property_id',
        'title',
        'description',
        'metadata',
        'installed_at',
        'last_service_at',
        'expires_at',
        'deleted_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'installed_at' => 'datetime:Y-m-d H:i:s',
        'last_service_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function softDelete(): bool
    {
        $this->deleted_at = now();

        return $this->save();
    }
}
