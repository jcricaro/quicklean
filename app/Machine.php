<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public function getTypeAttribute($value)
    {
    	return ucfirst($value);
    }

    public function getAvailabilityAttribute()
    {
    	return $this->jobs()->pending()->count() . ' Jobs Pending';
    }

    public function jobs()
    {
    	return $this->hasMany('App\Job', 'machine_id');
    }
}
