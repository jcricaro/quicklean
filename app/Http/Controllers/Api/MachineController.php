<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Machine;

class MachineController extends Controller
{
    public function all(Machine $machine)
    {
    	return $machine->all();
    }
}
