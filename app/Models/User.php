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

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'from_id_user');
    }

    public function recievedMessages()
    {
        return $this->hasMany(Message::class, 'to_id_user');
    }
}
