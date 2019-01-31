<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'fakultas', 'prodi', 'phone', 'origin', 'userid_created', 'userid_updated', 'noidentitas', 'type',
    ];
}
