<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Owner
{
    public function title()
    {
        return $this->full_name();
    }
}
