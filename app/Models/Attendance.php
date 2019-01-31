<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'event_id', 'participant_id', 'status', 'userid_created', 'userid_updated',
    ];
}
