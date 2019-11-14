<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
	protected $guarded = ['id'];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'author_id');
	}

	public function author_type()
	{
		return $this->user->owner_type ?? 'Database Error';
	}

	public function author_is_master()
	{
		return $this->author_type() == Master::class;
	}

	public function author()
	{
		$user = $this->user;
		if(!$user) return 'Database Error';
		if ($user->owner_type == Master::class) {
			return persian(Master::class);
		}else {
			return $user->owner ? $user->owner->title() : 'Database Error';
		}
	}
}
