<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectLeaderVacationsController extends Controller
{
    public function index()
    {
        $vacations = Vacation::where("employee", Auth::user()->id)->get();
        foreach($vacations as $vacation) {
            $project = Project::where("id", $vacation->project_lead_approved)->first();
            $team = Team::where("project", $project->id);
            //$teamleader = Employee::where("id", $team->leader)->first();
            //$vacation->team_lead_approved = $teamleader->name;
        }

        return view("projectleader.vacations", compact("vacations"));
    }

    public function request(Request $request)
    {
        $request->validate([
            'start' => ['required', 'date'],
            'end' => ["required", 'date'],
            'description' => ['required', 'string'],
        ]);

        $project = 3; //Team::where("leader", Auth::user()->id)->first();

        $vacation = Vacation::create([
            'employee' => Auth::user()->id,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'project_lead_approved' => $project
        ]);

        $vacation->save();
        
        return back()->with("message", "Vacation request sent.");
    }
}
