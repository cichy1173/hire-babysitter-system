<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_advertisement_type',
        'title',
        'content',
        'hour_rate',
        'age_min',
        'age_max',
        'child_num',
        'date_from',
        'date_to',
        'supervise_from',
        'supervise_to'
    ];
}
