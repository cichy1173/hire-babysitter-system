<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $table = 'availabilities';

    protected $fillable = [
        'start_time',
        'stop_time',
        'day',
        'id_user',
    ];
}
