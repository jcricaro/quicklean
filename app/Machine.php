<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    public function getTypeAttribute($value)
    {
    	return ucfirst($value);
    }

    public function getAvailabilityAttribute()
    {
        if( $this->type == 'Washer' ) {
            return $this->washJobs()->approved()->count() . ' Jobs Pending';
        }
    	return $this->dryJobs()->approved()->count() . ' Jobs Pending';
    }

    public function queueWasher()
    {
        return $this->washJobs()->where('status', 'pending_washer')->orderBy('approved_at', 'asc');
    }

    public function queueDryer()
    {
        return $this->dryJobs()->where('status', 'pending_dryer')->orderBy('approved_at', 'asc');   
    }

    public function queue()
    {
        if( $this->type == 'washer' ) {
            return $this->washJobs()->where('status', 'approved')->orderBy('approved_at', 'asc');
        }

        return $this->dryJobs()->where('status', 'approved')->orderBy('approved_at', 'asc');
    }

    public function scopeWasher($query)
    {
        return $query->where('type', 'washer');
    }

    public function scopeDryer($query)
    {
        return $query->where('type', 'dryer');
    }

    public function washJobs()
    {
        return $this->hasMany('App\Job', 'washer_id', 'id');
    }

    public function dryJobs()
    {
        return $this->hasMany('App\Job', 'dryer_id', 'id');
    }
}
