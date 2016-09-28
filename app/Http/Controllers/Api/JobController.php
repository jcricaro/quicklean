<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\AddJobReservationRequest;
use App\Job;
use App\Http\Requests\Job\AddJobWalkinRequest;
use Carbon\Carbon;
use App\Machine;
use App\Events\JobStatusChange;

class JobController extends Controller
{
    public function done(Job $job, Request $request)
    {
        $job->status = 'done';
        $job->save();

        event(new JobStatusChange($job));

        foreach($job->dryer->dryJobs()->pendingDryer()->get() as $otherJob) {
            event(new JobStatusChange($otherJob));
        }

        return response()->json([
            'message' => 'Status updated',
            'data' => $job
            ]);
    }

    public function queueDryer(Job $job, Machine $machine)
    {
        $job->status = 'pending_dryer';

        $dryer = $machine->dryer()->withCount('queueDryer')->orderBy('queue_dryer_count')->first();

        $job->dryer()->associate($dryer);

        $job->save();

        event(new JobStatusChange($job));
        
        foreach($job->washer->washJobs()->pendingWasher()->get() as $otherJob) {
            event(new JobStatusChange($otherJob));
        }

        return response()->json([
            'message' => 'Status updated',
            'data' => $job
            ]);
    }

    public function pay(Job $job)
    {
        $job->paid_at = Carbon::now();
        $job->save();

        return response()->json([
            'message' => 'success'
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
    		'reserve_at',
            'bleach_qty',
            'detergent_qty',
            'fabric_conditioner_qty'
    		]));

        $job->status = 'reserved';

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
