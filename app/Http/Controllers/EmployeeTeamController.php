<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeTeamController extends Controller
{
    public function index()
    {
        $member = Member::where("employee", Auth::user()->id)->first();
        $team = Team::findOrFail($member->team);
        $leader = Employee::findOrFail($team->leader);
        $project = Project::findOrFail($team->project);
        $team->leader = $leader->name;
        $team->project = $project->name;

        $members = Member::where("team", $member->team)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        return view("employee.team", compact("team"))->with(compact("employees"));
    }
}
