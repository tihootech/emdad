<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Madadju extends Model
{
    protected $guarded = ['id'];

    public function age()
    {
        if ($this->birthday) {
            return Carbon::parse($this->birthday)->age;
        }else {
            return null;
        }
    }
}
