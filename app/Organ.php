<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Owner
{
    public function title()
    {
        return $this->agency_name .' - '. $this->full_name();
    }
}
