<?php

namespace App\Http\Controllers;

use App\Listeners\CheckApproved;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingVacationProjectController extends Controller
{
    private $auth;

    public  function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function index() {
        $project = Project::where("leader", $this->auth::user()->id)->first();
        $team = Team::where("project", $project->id)->first();
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        $teamleader = Employee::where("id", $team->leader)->first();
        $leadervacations = Vacation::where("employee", $teamleader->id)->whereNull("project_lead_approved")->whereNot("status", "denied")->get();

        $vacations = Vacation::whereIn("employee", $members)->whereNull("project_lead_approved")->whereNot("status", "denied")->get();

        return view("projectleader.pending", compact("employees"))->with(compact("vacations"))->with(compact("teamleader"))->with(compact("leadervacations"));
    }
    public function approve(Vacation $vacation) {
        $project = Project::where("leader", Auth::user()->id)->first();
        $vacation->project_lead_approved = $project->id;
        event(new CheckApproved($vacation));
        $vacation->save();
        return back()->with("message", "Vacation succesfully approved");
    }
    public function deny(Vacation $vacation) {
        $project = Project::where("leader", Auth::user()->id)->first();
        $vacation->team_lead_approved = $project->id;
        $vacation->status = "denied";
        $vacation->save();
        return back()->with("message", "Vacation succesfully denied");
    }
}
