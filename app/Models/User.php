<?php

namespace App\Models;

use App\Models\Advertisement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'id_account_type',
        'nickname',
        'about',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',        
    ];

    

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisements()
    {
        return $this -> hasMany(Advertisement::class, 'id_user');
    }

    public function myApplications()
    {
        return $this -> belongsToMany(Advertisement::class, 'users_advertisements', 'id_user', 'id_advertisement')
            ->withPivot('time_from', 
                        'time_to', 
                        'accepted', 
                        'read_by_parent', 
                        'read_by_nanny', 
                        'created_user_opinion', 
                        'created_supervisor_opinion');
    }

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'from_id_user');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_id_user');
    }

    public function sendOpinions()
    {
        return $this->hasMany(Opinion::class, 'from_id_user');
    }

    public function receivedOpinions()
    {
        return $this->hasMany(Opinion::class, 'to_id_user');
    }
}
