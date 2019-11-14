<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'owner_type', 'owner_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_organ()
    {
        return $this->owner_type == Organ::class;
    }

    public function is_operator()
    {
        return $this->owner_type == Operator::class;
    }

    public function is_master()
    {
        return $this->owner_type == Master::class;
    }

    public function owner()
    {
        return $this->belongsTo($this->owner_type);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function fresh_notifications()
    {
        return $this->hasMany(Notification::class)->whereRead(0);
    }

    public function new_tickets()
    {
        return master() ? Ticket::whereStatus('open')->get() : Ticket::where('user_id', $this->id)->whereStatus('answered')->get();
    }

    public function region()
    {
        $owner = $this->owner;
        return $owner ? $owner->region : null;
    }

    public static function acc_for_owners($data, $id)
    {
        $user = new self;
        $user->owner_id = $id;
        $user->owner_type = $data['owner_type'];
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
