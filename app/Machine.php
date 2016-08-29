<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public function getTypeAttribute($value)
    {
    	return ucfirst($value);
    }
}
