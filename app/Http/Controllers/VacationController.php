<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function index() {
        $vacations = Vacation::paginate();

        foreach($vacations as $vacation) {
            $employee = Employee::findOrFail($vacation->employee);
            $team = Team::where("leader", $vacation->team_lead_approved);
            $team = Employee::findOrFail($team);
            $project = Project::where("leader", $vacation->project_lead_approved);
            $project = Project::findOrFail($project);
            $vacation->employee = $employee->name;
            $vacation->team = $team->name;
            $vacation->project = $project->name;
        }

        return view("admin.vacation", compact("vacations"));
    }
}
