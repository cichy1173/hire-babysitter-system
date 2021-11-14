<?php

namespace App\Models;

use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users_Advertisements extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_advertisement',
        'id_user',
        'time_from',
        'time_to',
        'accepted',
    ];

    protected $dates = [
        'time_from',
        'time_to',        
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function advert()
    {
        return $this->belongsTo(Advertisment::class);
    }
}
