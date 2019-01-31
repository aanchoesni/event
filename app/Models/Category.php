<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;

    public static $rules = [
        'name' => 'required',
    ];

    public static $errormessage = [
        'name' => 'Masukkan Nama Kategori',
    ];

    protected $fillable = [
        'id', 'code', 'name', 'description', 'userid_created', 'userid_updated',
    ];
}
