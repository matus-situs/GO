<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeProjectController extends Controller
{
    public function index()
    {
        $member = Member::where("employee", Auth::user()->id)->first();
        $team = Team::findOrFail($member->team);
        $project = Project::findOrFail($team->project);
        $leader = Employee::findOrFail($project->leader);
        $project->leader = $leader->name;

        return view("employee.project", compact("project"));
    }
}
