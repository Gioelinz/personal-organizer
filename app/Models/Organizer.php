<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable = [
        'user_id', 'description', 'expire', 'reminder', 'notification'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
