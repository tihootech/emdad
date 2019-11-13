<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public static function notify($history_notification_id, $owners_list)
    {
		$records = [];
    	foreach ($owners_list as $owner) {
    		$row['notification_history_id'] = $history_notification_id;
    		$row['user_id'] = $owner->user_id;
			$records []= $row;
    	}
		self::insert($records);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function history()
    {
        return $this->belongsTo(NotificationHistory::class, 'notification_history_id');
    }

    public function mark_as_read()
    {
        $this->read = 1;
        $this->save();
    }
}
