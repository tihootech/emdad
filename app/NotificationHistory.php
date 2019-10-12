<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    public static function make($target, $body)
    {
    	$history = new self;
        $history->target = $target;
		$history->body = $body;
		$history->save();
		return $history;
    }
}
