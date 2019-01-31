<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Participant extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'event_id', 'user_id', 'is_valid', 'userid_created', 'userid_updated',
    ];

    public function rEvent()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with(['rDetail']);
    }
}
