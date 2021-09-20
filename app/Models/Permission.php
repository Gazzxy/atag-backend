<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public const T_MANAGING_ACCOUNT = 1;

    protected $table = 'permissions';

    public $timestamps = true;

    protected $fillable = [
        'permission',
        'description',
        'created_at',
        'updated_at'
    ];
}
