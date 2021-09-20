<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAccountType extends Model
{
    public const T_MANAGING_ACCOUNT = 1;
    public const T_USER_ACCOUNT = 10;

    protected $table = 'client_account_types';

    public $timestamps = true;

    protected $casts = [
        'config' => 'array'
    ];
}
