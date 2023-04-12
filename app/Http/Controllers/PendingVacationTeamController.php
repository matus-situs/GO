<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event\Approved;
use App\Listeners\CheckApproved;

class PendingVacationTeamController extends Controller
{
    private $user;

    public  function __construct()
    {
        $this->user = app()->make(Auth::class);
    }

    public function index() {
        $team = Team::where("leader", $this->user::user()->id)->first();
        $project = Project::findOrFail($team->project);
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        $projectleader = Employee::where("id", $project->leader)->first();
        $leadervacations = Vacation::whereIn("employee", $projectleader)->whereNull("team_lead_approved")->whereNot("status", "denied")->get();

        $vacations = Vacation::whereIn("employee", $members)->whereNull("team_lead_approved")->whereNot("status", "denied")->get();

        return view("teamleader.pending", compact("employees"))->with(compact("vacations"))->with(compact("projectleader"))->with(compact("leadervacations"));
    }
    public function approve($id) {
        $vacation = Vacation::findOrFail($id);
        $team = Team::where("leader", Auth::user()->id)->first();
        $vacation->team_lead_approved = $team->id;
        event(new Approved($vacation));  
        $vacation->save();
        
        return back()->with("message", "Vacation succesfully approved");
    }
    public function deny($id) {
        $vacation = Vacation::findOrFail($id);
        $team = Team::where("leader", Auth::user()->id)->first();
        $vacation->team_lead_approved = $team->id;
        $vacation->status = "denied";
        $vacation->save();
        return back()->with("message", "Vacation succesfully denied");
    }
}
