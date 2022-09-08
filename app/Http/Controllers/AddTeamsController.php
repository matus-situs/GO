<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class AddTeamsController extends Controller
{
    public function index() {
        $leaders = Employee::where("role", "team leader")->get();
        $projects = Project::all();
        return view("admin.addteams", compact("leaders"))->with(compact("projects"));
    }
}
