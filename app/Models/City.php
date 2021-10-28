<?php

namespace App\Models;

use App\Models\District;
use App\Models\Voivodeship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'id_voivodeship'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function voivodeship()
    {
        return $this->belongsTo(Voivodeship::class);
    }
}
