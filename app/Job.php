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
        'is_fold',
        'reserve_at',
        'status',
        'detergent_qty',
        'bleach_qty',
        'fabric_conditioner_qty'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_press' => 'boolean',
        'is_fold' => 'boolean'
    ];

    protected $dates = [
        'approved_at',
        'reserve_at'
    ];

    protected $appends = [
        'queue',
        'total_bill'
    ];

    public function setReserveAtAttribute($value)
    {
        $this->attributes['reserve_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

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

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePendingDryer($query)
    {
        return $query->where('status', 'pending_dryer');
    }

    public function scopePendingWasher($query)
    {
        return $query->where('status', 'pending_washer');
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
        return $query->where('status', 'queue');
    }

    public function getStatusAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }

    public function washer()
    {
        return $this->belongsTo('App\Machine', 'washer_id');
    }

    public function dryer()
    {
        return $this->belongsTo('App\Machine', 'dryer_id');
    }

    public function scopeReservation($query)
    {
        return $query->whereNotNull('reserve_at')->whereIn('status', ['reserved', 'approved']);
    }

    public function scopeWalkin($query)
    {
        return $query->whereNull('reserve_at');
    }

    public function getTotalBillAttribute()
    {
        $total = 0;

        if($this->is_fold) {
            $total += 35;
        }

        switch ($this->detergent) {          
            case 'Ariel':
                $total += 12;
                break;
            case 'Tide':
                $total += 10;
                break;
            case 'Pride':
                $total += 6;
                break;
            default:
                # code...
                break;
        }

        if($this->fabric_conditioner == 'Downy') {
            $total += 10;
        }

        switch ($this->bleach) {
            case 'Colorsafe':
                $total += 5;
            case 'Original':
                $total += 12;
            default:
                # code...
                break;
        }

        switch ($this->washer_mode) {
            case 'Clean':
                if($this->kilogram == '8 kg') {
                    $total += 70;
                } else {
                    $total += 140;    
                }
                break;
            case 'Cleaner':
                if($this->kilogram == '8 kg') {
                    $total += 80;
                } else {
                    $total += 160;    
                }
            case 'Cleanest':
                if($this->kilogram == '8 kg') {
                    $total += 90;
                } else {
                    $total += 180;    
                }
            default:
                # code...
                break;
        }

        switch ($this->dryer_mode) {
            case '19 mins':
                if($this->kilogram == '8 kg') {
                    $total += 70;
                } else {
                    $total += 140;    
                }
                break;
            case '24 mins':
                if($this->kilogram == '8 kg') {
                    $total += 80;
                } else {
                    $total += 160;    
                }
            case '29 mins':
                if($this->kilogram == '8 kg') {
                    $total += 90;
                } else {
                    $total += 180;    
                }
            default:
                # code...
                break;
        }

        return $total;
    }

    public function getUuidAttribute()
    {
        if( is_null($this->reserve_at) ) {
            return str_pad($this->id, 5, '0', STR_PAD_LEFT);    
        }
        return 'S' . $this->reserve_at->format('dmyA') . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function getQueueAttribute()
    {
        
        if($this->status == 'Pending washer') {
            $machine = $this->washer;
            $jobs = $machine->washJobs()->pendingWasher()->get();
        } elseif ($this->status == 'Pending dryer') {
            $machine = $this->dryer;
            $jobs = $machine->dryJobs()->pendingDryer()->get();
        } else {
            return null;
        }

        foreach($jobs as $index => $job) {
            if($job->id == $this->id) {
                return $index + 1;
            }
        }
    }

    public function setIsFoldAttribute($value)
    {
        $this->attributes['is_fold'] = isset($value) ? true : false;
    }

    public function setIsPressAttribute($value)
    {
        $this->attributes['is_press'] = isset($value) ? true : false;
    }

    public function isEditable()
    {
        if( in_array($this->status, ['Reserved', 'Approved']) ) {
            return true;
        }
        return false;
    }
}
