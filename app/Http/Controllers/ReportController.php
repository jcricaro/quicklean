<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Job;

class ReportController extends Controller
{
    public function home(Job $job)
    {
    	$jobs = $job->paid()->paginate();

    	return view('reports.report')
    		->with('jobs', $jobs);
    }
}
