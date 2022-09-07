<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Project::paginate();

        return view("admin.projects", compact("projects"));
    }
    public function post(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $project = Project::create([
            'name' => $request->name,
            "leader" => $request->leader,
        ]);

        $project->save();
        
        return back()->with("message", "Project created successfully");
    }
}
