<?php

namespace App\Listeners;

use App\Event\Approved;
use App\Repositories\EmployeeRepository;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckApproved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Event\Approved  $event
     * @return void
     */
    public function handle(Approved $event)
    {
        if($event->vacation->project_lead_approved != null && $event->vacation->team_lead_approved) {
            $event->vacation->status = "approved";

            $repository = new EmployeeRepository;
            $employee = $repository->findByVacation($event->vacation);

            $startdate = new DateTime($event->vacation->start);
            $enddate = new DateTime($event->vacation->end);

            $interval = $startdate->diff($enddate);
            $days = $interval->format("%a");

            $employee->remaining_vacation -= $days; 
            $employee->save();
        }
    }
}
