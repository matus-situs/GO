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
            if($vacation->project_lead_approved != null) {
                $team = Team::where("leader", $vacation->team_lead_approved)->first();
                $team = Employee::findOrFail($team);
                $vacation->team = $team->name;
            }
            
            if($vacation->project_lead_approved != null) {
                $project = Project::where("leader", $vacation->project_lead_approved)->first();
                $project = Project::findOrFail($project);
                $vacation->project = $project->name;
            }
            
            $vacation->employee = $employee->name;
        }

        return view("admin.vacation", compact("vacations"));
    }
}
