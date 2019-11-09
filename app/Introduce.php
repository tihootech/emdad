<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    protected $guarded = ['id'];

    public function madadju()
    {
        return $this->belongsTo(Madadju::class);
    }

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function status_name()
    {
        if($this->status == 1) return 'معلق';
        if($this->status == 2) return 'تاییدشده';
        if($this->status == 3) return 'ردشده';
    }

}
