<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = [
        "identifier", "name", "shortcode", 'active', 'added_by', 'activated_by', 'activated_at', 'updated_by'
    ];

    public function country()
    {
        return $this->hasMany(Country::class);
    }
}
