<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
	protected $guarded = ['id'];

	public function user()
	{
		return $this->morphOne(User::class, 'owner');
	}

    public function full_name()
    {
		if ($this->first_name == $this->last_name) {
			return $this->first_name;
		}else {
			return $this->first_name .' '. $this->last_name;
		}
    }

	public function type()
	{
		$user = $this->user;
		return $user ? strtolower(str_replace('App\\', '', $user->owner_type)) : null;
	}

	public function full_type()
	{
		return $this->user->owner_type ?? null;
	}

	public function persian_type()
	{
		$type = $this->type();
		return $type == 'operator' ? 'مددکار' : 'موسسه';
	}
}
