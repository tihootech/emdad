<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Owner
{
    public function title()
    {
        return $this->agency_name .' - '. $this->full_name();
    }

    public function fresh_introduces()
    {
        return $this->hasMany(Introduce::class)->where('status', 1);
    }

}
