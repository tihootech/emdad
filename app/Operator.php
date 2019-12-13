<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Owner
{
    public function title()
    {
        return $this->full_name() . '-' . 'منظقه ' . $this->region;
    }

    public function madadjus()
    {
        return $this->hasMany(Madadju::class);
    }

    public function introduces()
    {
        return $this->hasMany(Introduce::class);
    }
}
