<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $dates = [
        'date_from',
        'date_to',
        'supervise_from',
        'supervise_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'districts_advertisements', 'id_advertisement', 'id_district');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skills_advertisements', 'id_advertisement', 'id_skill');
    }

    public function applications()
    {
        return $this -> belongsToMany(User::class, 'users_advertisements', 'id_advertisement', 'id_user')
            ->withPivot('time_from', 
                            'time_to', 
                            'accepted', 
                            'read_by_parent', 
                            'read_by_nanny', 
                            'created_user_opinion', 
                            'created_supervisor_opinion');
    }
}
