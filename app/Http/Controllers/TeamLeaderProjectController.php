<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderProjectController extends Controller
{
    public function index()
    {
        $team = Team::where("leader", Auth::user()->id)->first();
        $project = Project::findOrFail($team->project);
        $leader = Employee::findOrFail($project->leader);
        $project->leader = $leader->name;

        return view("teamleader.project", compact("project"));
    }
}
