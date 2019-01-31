<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $incrementing = false;

    public static $rules = [
        'code' => 'required',
        'unit_id' => 'required',
        'type_id' => 'required',
        'category_id' => 'required',
        'title' => 'required',
        'place' => 'required',
        'date' => 'required',
        'times' => 'required',
        'quota' => 'required',
        'start_reg' => 'required',
        'end_reg' => 'required',
        'publication_status' => 'required',
        'pay_status' => 'required',
    ];

    public static $errormessage = [
        'code' => 'Masuk Code',
        'unit_id' => 'Pilih Unit',
        'type_id' => 'Pilih Jenis Peserta',
        'category_id' => 'Pilih Kategori',
        'title' => 'Masukkan Judul Kegiatan',
        'place' => 'Masukkan Tempat Kegiatan',
        'date' => 'Masukkan Tanggal Kegiatan',
        'times' => 'Masukkan Waktu Kegiatan',
        'quota' => 'Masukkan Jumlah Maksimal Peserta Kegiatan',
        'start_reg' => 'Masukkan Mulai Pendaftaran',
        'end_reg' => 'Masukkan Akhir Pendaftaran',
        'publication_status' => 'Pilih Status Publish',
        'pay_status' => 'Pilih Status Gratis',
    ];

    protected $fillable = [
        'id', 'code', 'unit_id', 'type_id', 'category_id', 'title', 'theme', 'place', 'date', 'times', 'quota', 'pamphlet', 'start_reg', 'end_reg', 'publication_status', 'pay_status', 'start_pay', 'end_pay', 'bank_name', 'bank_number', 'bank_owner', 'cost', 'userid_created', 'userid_updated', 'description'
    ];

    public function rCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function rUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function rParticipant()
    {
        return $this->belongsTo(Participant::class, 'id', 'event_id');
    }

    public function rEventParticipant()
    {
        return $this->hasMany(Participant::class, 'id', 'event_id');
    }
}
