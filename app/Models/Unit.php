<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $incrementing = false;

    public static $rules = [
        'name' => 'required',
        'shortname' => 'required',
    ];

    public static $errormessage = [
        'name' => 'Masukkan Nama Unit',
        'shortname' => 'Masukkan Nama Pendek Unit',
    ];

    protected $fillable = [
        'id', 'code', 'name', 'description', 'shortname', 'userid_created', 'userid_updated',
    ];
}
