<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User2Permission extends Model
{
    protected $table = 'users2permissions';
    protected $fillable = ['user_id', 'permission_id'];
    public $timestamps = true;
}
