<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingVacationTeamController extends Controller
{
    public function index() {
        $team = Team::where("leader", Auth::user()->id)->first();
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();
        $vacations = Vacation::whereIn("employee", $members)->whereNull("team_lead_approved")->whereNot("status", "denied")->get();

        return view("teamleader.pending", compact("employees"))->with(compact("vacations"));
    }
    public function approve($id) {
        $vacation = Vacation::findOrFail($id);
        $team = Team::where("leader", Auth::user()->id)->first();
        $vacation->team_lead_approved = $team->id;
        if($vacation->project_lead_approved != null) {
            $vacation->status = "approved";
        }
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
