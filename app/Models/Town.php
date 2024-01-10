<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier', 'name', 'shortcode', 'county_id', 'active', 'added_by', 'activated_by', 'activated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'activated_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
