<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    public const S_ACTIVE = 1;
    public const S_PENDING = 10;
    public const S_SUSPENDED = 20;
    public const S_EXPIRED = 30;

    protected $table = 'user_statuses';

    public $timestamps = true;

    protected $casts = [
        'config' => 'array'
    ];
}
