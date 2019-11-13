<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    public static function make($target, $body)
    {
    	$history = new self;
        $history->uid = rs();
        $history->target = $target;
		$history->body = $body;
		$history->save();
		return $history;
    }

    public function list($value='')
    {
        return $this->hasMany(Notification::class);
    }

    public function send_to_count()
    {
        return $this->list->count();
    }
}
