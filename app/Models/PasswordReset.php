<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $fillable = ['user_id', 'created_at'];
    public $timestamps = false;

    public function getResetLink()
    {
        return sprintf("%s/reset-password?slug=%s", request()->getSchemeAndHttpHost(), $this->getUniqueUrlSlug());
    }

    public function getUniqueUrlSlug()
    {
        return encrypt(json_encode([
            'id' => $this->id,
            'date' => now()->format('Y-m-d H:i:s')
        ]));
    }
}
