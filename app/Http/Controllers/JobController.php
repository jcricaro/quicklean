<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Job;
use Carbon\Carbon;
use App\Machine;

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

    public function approve(Job $job, Request $request, Machine $machine)
    {
        $job->status = 'approved';
        $job->approved_at = Carbon::now();

        // assign to washer with the least amount of pending
        // 
        
        $washer = $machine->washer()->withCount('queueWasher')->orderBy('queue_washer_count')->first();

        $job->washer()->associate($washer);


        // assign to dryer with the least amount of pending
        
        $dryer = $machine->dryer()->withCount('queueDryer')->orderBy('queue_dryer_count')->first();

        $job->dryer()->associate($dryer);

        $job->save();

        return redirect('/jobs?page=' . $request->get('page', 1))->with('success', 'Job approved');
    }

    public function decline(Job $job, Request $request)
    {
        $job->status = 'declined';
        $job->save();

        return redirect('/jobs?page=' . $request->get('page', 1))->with('success', 'Job declined');
    }

    public function done(Job $job, Request $request)
    {
        $job->status = 'done';
        $job->save();

        return redirect('/jobs?page=' . $request->get('page', 1))->with('success', 'Job done!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
