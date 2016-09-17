<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\AddJobReservationRequest;
use App\Job;
use App\Http\Requests\Job\AddJobWalkinReqeust;

class JobController extends Controller
{
    public function storeWalkin(AddJobWalkinReqeust $request, Job $job)
    {
        $job = $job->create(array_merge($request->only([
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
            ])), ['status' => 'approved']);

        $job->save();

        return response()->json([
            'message' => 'Reserved',
            'data' => $job->toArray()
            ]);
    }

    public function store(AddJobReservationRequest $request, Job $job)
    {
    	$job = $job->create($request->only([
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
    		'status',
    		'reserve_at'
    		]));
    	
    	return response()->json([
    		'message' => 'Reserved',
    		'data' => $job->toArray()
    		]);
    }

    public function show(Job $job)
    {
        return response()->json([
            'data' => $job->toArray()
            ]);
    }

    public function cancel(Job $job)
    {
        $job->status = 'cancelled';
        $job->save();

        return response()->json([
            'message' => 'Job Cancelled'
            ]);
    }
}
