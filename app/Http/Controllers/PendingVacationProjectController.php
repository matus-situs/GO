<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingVacationProjectController extends Controller
{
    public function index() {
        $project = 5;//$project = Project::where("leader", Auth::user()->id)->first();
        $team = Team::where("project", $project)->first();
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();
        $vacations = Vacation::whereIn("employee", $members)->whereNull("project_lead_approved")->whereNot("status", "denied")->get();

        return view("projectleader.pending", compact("employees"))->with(compact("vacations"));
    }
    public function approve($id) {
        $vacation = Vacation::findOrFail($id);
        $project = 5;//$project = Project::where("leader", Auth::user()->id)->first();
        $vacation->project_lead_approved = $project;
        if($vacation->team_lead_approved != null) {
            $vacation->status = "approved";
        }
        $vacation->save();
        return back()->with("message", "Vacation succesfully approved");
    }
    public function deny($id) {
        $vacation = Vacation::findOrFail($id);
        $project = 5;//$project = Project::where("leader", Auth::user()->id)->first();
        $vacation->team_lead_approved = $project;
        $vacation->status = "denied";
        $vacation->save();
        return back()->with("message", "Vacation succesfully denied");
    }
}
