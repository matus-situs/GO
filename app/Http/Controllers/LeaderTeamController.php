<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderTeamController extends Controller
{
    public function index()
    {
        $team = Team::where("leader", Auth::user()->id)->first();
        $project = Project::findOrFail($team->project);
        $team->project = $project->name;

        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        return view("teamleader.team", compact("team"))->with(compact("employees"));
    }
}

