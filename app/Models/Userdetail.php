<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    public $incrementing = false;

    public static $rules = [
        'type_id' => 'required',
        'phone' => 'required',
        'origin' => 'required',
        'noidentitas' => 'required',
    ];

    public static $errormessage = [
        'type_id' => 'Pilih Tipe Peserta',
        'phone' => 'Masukkan Nomor HP',
        'origin' => 'Masukkan Asal',
        'noidentitas' => 'Masukkan Nomor Identitas',
    ];

    protected $fillable = [
        'id', 'user_id', 'fakultas', 'prodi', 'phone', 'origin', 'userid_created', 'userid_updated', 'noidentitas', 'type',
    ];
}
