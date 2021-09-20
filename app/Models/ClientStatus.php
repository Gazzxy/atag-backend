<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    public const S_ACTIVE = 1;
    public const S_PENDING = 10;
    public const S_SUSPENDED = 20;
    public const S_EXPIRED = 30;

    protected $table = 'client_statuses';

    public $timestamps = true;

    protected $casts = [
        'config' => 'array'
    ];

    public static function randomStatus(): int
    {
        $statuses = [1, 10, 20, 30];

        return $statuses[rand(0, sizeof($statuses) - 1)];
    }
}
