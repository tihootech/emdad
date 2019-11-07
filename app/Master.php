<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $guarded = ['id'];

    public function full_name()
    {
        return $this->first_name .' '. $this->last_name;
    }
}
