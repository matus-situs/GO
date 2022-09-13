<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Team;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeesOnVacationController extends Controller
{
    public function index() {
        $team = Team::where("leader", Auth::user()->id)->first();
        $members = Member::where("team", $team->id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();
        $vacations = Vacation::whereIn("employee", $members)->whereNotNull("team_lead_approved")->where("status", "approved")->orderBy("start", "desc")->get();

        return view("teamleader.employeesonvacation", compact("employees"))->with(compact("vacations"));
    }
}
