<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $incrementing = false;

    public static $rules = [
        'bank_sender' => 'required',
        'bank_owner' => 'required',
        'total' => 'required',
    ];

    public static $errormessage = [
        'bank_sender' => 'Masukkan Bank Pengirim',
        'bank_owner' => 'Masukkan Nama Pengirim',
        'total' => 'Masukkan Total yang Di Kirim',
    ];

    protected $fillable = [
        'id', 'event_id', 'participant_id', 'bank_sender', 'bank_owner', 'total', 'pay_status', 'userid_created', 'userid_updated',
    ];
}
