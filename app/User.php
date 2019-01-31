<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Userdetail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $incrementing = false;
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role', 'login_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rDetail()
    {
        return $this->belongsTo(Userdetail::class, 'id', 'user_id')->with(['rUnit', 'rType']);
    }
}
