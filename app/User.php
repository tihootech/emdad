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

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function fresh_notifications()
    {
        return $this->hasMany(Notification::class)->whereRead(0);
    }
}
