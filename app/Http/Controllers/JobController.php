<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Job;
use Carbon\Carbon;
use App\Machine;
use App\Http\Requests\Job\AddJobReservationRequest;
use App\Http\Requests\Job\AddJobWalkinRequest;
use App\Events\JobStatusChange;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job, Request $request)
    {
        $jobs = $job->orderBy('id', 'desc')->paginate();

        return view('jobs.list')->with('jobs', $jobs);
    }

    public function queueWasher(Job $job, Machine $machine)
    {
        $job->status = 'pending_washer';
        
        $washer = $machine->washer()->withCount('queueWasher')->orderBy('queue_washer_count')->first();

        $job->washer()->associate($washer);

        $job->save();

        event(new JobStatusChange($job));

        return redirect('/jobs/queue')->with('success', 'Job Queued');
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

        return redirect('/jobs/queue')->with('success', 'Job Queued');
    }

    public function approve(Job $job, Request $request, Machine $machine)
    {
        $job->status = 'approved';
        $job->approved_at = Carbon::now();

        $job->save();

        event(new JobStatusChange($job));

        return redirect('/jobs/queue')->with('success', 'Job Approved');
    }

    public function decline(Job $job, Request $request)
    {
        $job->status = 'declined';
        $job->save();

        event(new JobStatusChange($job));

        return redirect('/jobs/queue')->with('success', 'Job declined');
    }

    public function cancel(Job $job, Request $request)
    {
        $job->status = 'cancelled';
        $job->save();

        event(new JobStatusChange($job));

        return redirecT('/jobs/queue')->with('success', 'Job cancelled');
    }

    public function done(Job $job, Request $request)
    {
        $job->status = 'done';
        $job->save();

        event(new JobStatusChange($job));

        foreach($job->dryer->dryJobs()->pendingDryer()->get() as $otherJob) {
            event(new JobStatusChange($otherJob));
        }

        return redirect('/jobs/queue')->with('success', 'Job Done!');
    }

    public function paid(Job $job)
    {
        $job->status = 'paid';
        $job->save();

        event(new JobStatusChange($job));

        return redirect('/jobs/queue')->with('success', 'Job Paid!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $job->create($request->only([
            'name',
            'phone',
            'service_type',
            'kilogram',
            'washer_mode',
            'dryer_mode',
            'detergernt',
            'bleach',
            'fabric_conditioner',
            'is_press',
            'is_fold'
            ]));

        $job->save();

        return redirect('/jobs')->with('success', 'Job Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $id)
    {
        $job->delete();

        return redirect('/jobs')->with('success', 'Job Deleted');
    }

    public function storeReservation(AddJobReservationRequest $request, Job $job)
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
            'is_fold'
            ]));


        $job->reservation = date('Y-m-d H:i:s', strtotime($request->get('time')));

        $job->save();

        return redirect('/jobs/reservations?page=' . $request->get('page', 1))->with('success', 'Job Reserved');
        
    }

    public function reservation()
    {
        return view('jobs.reservation');
    }

    public function walkin()
    {
        return view('jobs.walkin');
    }

    public function storeWalkin(AddJobWalkinRequest $request, Job $job, Machine $machine)
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

        // assign to washer with the least amount of pending
        
        $washer = $machine->washer()->withCount('queueWasher')->orderBy('queue_washer_count')->first();

        $job->washer()->associate($washer);

        // assign to dryer with the least amount of pending
        
        $dryer = $machine->dryer()->withCount('queueDryer')->orderBy('queue_dryer_count')->first();

        $job->dryer()->associate($dryer);

        $job->save();

        return redirect('/jobs/queue')->with('success', 'Job Approved');
    }

    /**
     * Get Queue
     * @param  Job     $job     App\Job
     * @param  Machine $machine App\Machine
     * @return Response
     */
    public function getQueue(Job $job, Machine $machine)
    {
        $reservations = $job->reservation()->orderBy('status', 'asc')->get();

        $pending = $job->approved()->walkin()->get();

        $done = $job->done()->get();

        return view('jobs.queue')->with([
            'washers' => $machine->washer()->get(),
            'dryers' => $machine->dryer()->get(),
            'reservations' => $reservations,
            'pendings' => $pending,
            'done' => $done
            ]);
    }
}
