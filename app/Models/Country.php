<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        "identifier", "name", "continent_id", "shortcode", 'active', 'added_by', 'activated_by', 'activated_at'
    ];

    public function counties()
    {
        return $this->hasMany(County::class);
    }
}
