<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function notification_history()
	{
		return $this->belongsTo(NotificationHistory::class, 'notification_history_uid', 'uid');
	}

	public function messages()
	{
		return $this->hasMany(TicketMessage::class)->latest();
	}

    public function persian_status()
    {
        if($this->status == 'open') return 'باز';
        if($this->status == 'answered') return 'پاسخ داده شده';
        if($this->status == 'closed') return 'بسته شده';
    }

    public function persian_priority()
    {
        if($this->priority == 1) return 'پایین';
        if($this->priority == 2) return 'متوسط';
        if($this->priority == 3) return 'بالا';
    }

    public function persian_type()
    {
        if($this->type == 'complaint') return 'شکایت';
        if($this->type == 'official') return 'اداری';
    }

    public function status_color()
    {
        if($this->status == 'open') return 'warning';
        if($this->status == 'answered') return 'success';
        if($this->status == 'closed') return 'danger';
    }

    public function priority_color()
    {
        if($this->priority == 1) return 'secondary';
        if($this->priority == 2) return 'info';
        if($this->priority == 3) return 'danger';
    }

    public function type_color()
    {
        if($this->type == 'complaint') return 'danger';
        if($this->type == 'official') return 'info';
    }
}
