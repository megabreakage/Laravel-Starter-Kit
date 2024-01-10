<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier', 'name', 'shortcode', 'country_id', 'active', 'added_by', 'activated_by', 'activated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'activated_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function towns()
    {
        return $this->hasMany(Town::class);
    }
}
