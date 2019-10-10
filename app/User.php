<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fresh_introduces()
    {
        return $this->hasMany(Introduce::class, 'organ_id')->where('status', 1);
    }
}
