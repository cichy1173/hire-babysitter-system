<?php

namespace App\Models;

use App\Models\Voivodeship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name'
    ];

    public function voivodeships()
    {
        return $this->hasMany(Voivodeship::class);
    }
}
