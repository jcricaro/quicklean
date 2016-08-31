<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * Tables name
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'service_type',
        'kilogram',
        'washer_mode',
        'dryer_mode',
        'detergent',
        'bleach',
        'fabric_conditioner',
        'is_press',
        'is_fold'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_press' => 'boolean',
        'is_fold' => 'boolean'
    ];

    protected $dates = [
        'approved_at'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getServiceTypeAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getKilogramAttribute($value)
    {
        return $value . ' kg';
    }

    /**
     * @param $value
     * @return string
     */
    public function getWasherModeAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getDryerModeAttribute($value)
    {
        return $value . ' mins';
    }

    /**
     * @param $value
     * @return string
     */
    public function getDetergentAttribute($value)
    {
        return ucfirst( str_replace('_', ' ', $value) );
    }

    /**
     * @param $value
     * @return string
     */
    public function getBleachAttribute($value)
    {
        return ucfirst( str_replace('_', ' ', $value) );
    }

    /**
     * @param $value
     * @return string
     */
    public function getFabricConditionerAttribute($value)
    {
        return ucfirst( str_replace('_', ' ', $value) );
    }

    
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function scopeDone($query)
    {
        return $query->where('status', 'done');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function washer()
    {
        return $this->belongsTo('App\Machine', 'washer_id');
    }

    public function dryer()
    {
        return $this->belongsTo('App\Machine', 'dryer_id');
    }
}
