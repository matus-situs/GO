<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeVacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::where("employee", Auth::user()->id)->get();
        $member = Member::where("employee", Auth::user()->id)->first();
        $team = Team::findOrFail($member->team);
        $teamleader = Employee::findOrFail($team->leader);
        $project = Project::findOrFail($team->project);
        $projectleader = Employee::findOrFail($project->leader);
        $vacations->team_lead_approved = $teamleader->name;
        $team->projectlead_approved = $projectleader->name;

        return view("employee.vacations", compact("vacations"));
    }

    public function request(Request $request)
    {
        $request->validate([
            'start' => ['required', 'date'],
            'end' => ["required", 'date'],
            'description' => ['required', 'string'],
        ]);

        $vacation = Vacation::create([
            'employee' => Auth::user()->id,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
        ]);

        $vacation->save();
        
        return back()->with("message", "Vacation request sent.");
    }
}
