<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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

        if ($request->start < Carbon::now()) {
            return back()->with("message", "Starting date can't be the past.");
        }

        if ($request->start < Carbon::now()->addDays(7)) {
            return back()->with("message", "Vacation must be submitted at least 7 days in advance.");
        }

        if ($request->end < $request->start) {
            return back()->with("message", "Vacation can't end before it begins.");
        }

        $startdate = Carbon::createFromFormat('Y-m-d', $request->start);
        $enddate = Carbon::createFromFormat('Y-m-d', $request->end);
        $diffdays = $startdate->diffInDays($enddate);

        if ($diffdays > Auth::user()->remaining_vacation) {
            return back()->with("message", "You dont have that much vacation days.");
        }

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
