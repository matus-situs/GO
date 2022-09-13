<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectLeaderProjectController extends Controller
{
    public function index()
    {
        $project = Project::where("leader", Auth::user()->id)->where("id", 3)->first();
        $team = Team::where("project", $project->id)->first();
        $teamleader = Employee::where("id", $team->leader)->first();
        $team->leader = $teamleader->name." ".$teamleader->surname;
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        return view("projectleader.project", compact("project"))->with(compact("team"))->with(compact("employees"));
    }
}
