<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    /**
     * Tables name
     *
     * @var string
     */
    protected $table = 'tips';
    
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'content'
    ];
}
