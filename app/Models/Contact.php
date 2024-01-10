<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable =[
        'identifier',
        'name',
        'contact_type_id',
        'value',
        'active',
        'added_by',
        'updated_by',
        'activated_by',
        'activated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'activated_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
