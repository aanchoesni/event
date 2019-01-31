<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $incrementing = false;

    public static $rules = [
        'name' => 'required',
    ];

    public static $errormessage = [
        'name' => 'Masukkan Nama Tipe Peserta',
    ];

    protected $fillable = [
        'id', 'code', 'name', 'description', 'userid_created', 'userid_updated',
    ];
}
