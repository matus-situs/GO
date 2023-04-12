<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamLeaderVacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::where("employee", Auth::user()->id)->get();
        $team = Team::where("leader", Auth::user()->id)->first();
        $project = Project::findOrFail($team->project);
        $projectleader = Employee::findOrFail($project->leader);
        $vacations->team_lead_approved = Auth::user()->name;
        $vacations->project_lead_approved = $projectleader->name;

        return view("teamleader.vacations", compact("vacations"));
    }

    public function request(Request $request)
    {
        $request->validate([
            'start' => ['required', 'date'],
            'end' => ["required", 'date'],
            'description' => ['required', 'string'],
        ]);

        if($request->start < Carbon::now()){
            return back()->with("message", "Starting date can't be the past.");
        }

        if($request->start < Carbon::now()->addDays(7)){
            return back()->with("message", "Vacation must be submitted at least 7 days in advance.");
        }

        if($request->end < $request->start){
            return back()->with("message", "Vacation can't end before it begins.");
        }

        $team = Team::where("leader", Auth::user()->id)->first();

        $vacation = Vacation::create([
            'employee' => Auth::user()->id,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'team_lead_approved' => $team->id
        ]);

        $vacation->save();
        
        return back()->with("message", "Vacation request sent.");
    }
}
