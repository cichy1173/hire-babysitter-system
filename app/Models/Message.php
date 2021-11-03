<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'photo',
        'send_date',
        'read',
        'from_id_user',
        'to_id_user'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id_user');
    }
}
