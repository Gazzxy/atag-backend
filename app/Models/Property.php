<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    public $timestamp = true;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'address_formatted',
        'address_line_1',
        'address_line_2',
        'city',
        'postcode',
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
