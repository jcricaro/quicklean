<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Job\AddJobReservationRequest;
use App\Http\Requests\Job\AddJobWalkinRequest;
use App\Job;

class JobController extends Controller
{
    public function index()
    {
    	$user = Auth::user();

    	return response()->json(['data' => $user->jobs->all()]);
    }

    public function store(AddJobReservationRequest $request)
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
    		'reserve_at',
            'bleach_qty',
            'detergent_qty',
            'fabric_conditioner_qty'
    		]));

        $job->status = 'reserved';
        $job->user_id = Auth::user()->id;
        $job->save();

        return response()->json([
    		'message' => 'Reserved',
    		'data' => $job->toArray()
    		]);
    }

    public function storeWalkin(AddJobWalkinRequest $request, Job $job)
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
            'is_fold',
            'bleach_qty',
            'detergent_qty',
            'fabric_conditioner_qty'
            ])), ['status' => 'approved']);

        $job->status = 'approved';
        $job->user_id = Auth::user()->id;

        $job->save();

        return response()->json([
            'message' => 'Reserved',
            'data' => $job->toArray()
            ]);
    }

    public function show(Job $job)
    {
    	return response()->json([
    		'data' => $job->toArray()
    		])
    }
}
