<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'grade',
        'create_date',
        'from_id_user',
        'to_id_user'
    ];

    protected $dates = [
        'create_date'
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
