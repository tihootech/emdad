<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public static function notify($history_notification_id, $user_list)
    {
		$records = [];
    	foreach ($user_list as $user) {
    		$row['notification_history_id'] = $history_notification_id;
    		$row['user_id'] = $user->id;
			$records []= $row;
    	}
		self::insert($records);
    }
}
