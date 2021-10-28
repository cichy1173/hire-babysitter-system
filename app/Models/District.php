<?php

namespace App\Models;

use App\Models\City;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_name',
        'id_voivodeship'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'districts_advertisements', 'id_district', 'id_advertisement');
    }

}
