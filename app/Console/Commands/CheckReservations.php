<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Job;
use Carbon\Carbon;
use App\Machine;
use App\Events\JobStatusChange;

class CheckReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reservations, and queue them if need be';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Job $job, Machine $machine)
    {
        $job->where('status', 'pending')->whereNotNull('reserve_at')->whereBetween('reserve_at', [Carbon::now(), Carbon::now()->addMinutes(30)])->chunk(200, function ($jobs) use ($machine)
        {
            foreach($jobs as $job) {
                $job->status = 'approved';
                $job->approved_at = Carbon::now();

                $washer = $machine->washer()->withCount('queueWasher')->orderBy('queue_washer_count')->first();

                $job->washer()->associate($washer);

                $dryer = $machine->dryer()->withCount('queueDryer')->orderBy('queue_dryer_count')->first();

                $job->dryer()->associate($dryer);

                $job->save();

                event(new JobStatusChange($job));
            }
        });

        $job->whereNotNull('reserve_at')->where('status', 'reserved')->where('reserve_at', '<', Carbon::now())->chunk(200, function ($jobs)
        {
            foreach($jobs as $job) {
                $job->status = 'expired';
                $job->save();
            }
        });
    }
}
