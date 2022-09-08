<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamsController extends Controller
{
    public function index() {
        $teams = Team::paginate();

        foreach($teams as $team) {
            $leader = Employee::findOrFail($team->leader);
            $project = Project::findOrFail($team->project);
            $team->leader = $leader->name;
            $team->project = $project->name;
            $team->size = Member::where("team", $team->id)->count();
        }

        return view("admin.teams", compact("teams"));
    }
    public function post(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'leader' => ['required', 'int'],
            'project' => ['required', 'int'],
        ]);

        $team = Team::create([
            'name' => $request->name,
            "leader" => $request->leader,
            "project" => $request->project,
        ]);

        $team->save();
        
        return back()->with("message", "Team created successfully");
    }

    public function edit(int $id) {
        $leaders = Employee::where("role", "team leader")->get();
        $team = Team::findOrFail($id);
        $leader = Employee::findOrFail($team->leader);
        $project = Project::findOrFail($team->project);
        $team->leader = $leader->name;
        $team->project = $project->name; 
        return view("admin.editteam", compact("team"))->with(compact("leaders"));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => ['string', 'max:255'],
        ]);
        $team = Team::where('id',  $request->input("id"))->first();
        $team->name = $request->input("name");
        $team->leader = $request->input("leader");
        $team->save();

        return back()->with("message", "Team updated successfully");
    }

    public function members(int $id) {
        $members = Member::pluck("employee")->all();
        $employees = Employee::where("role", "employee")->whereNotIn("id", $members)->get();
        $team = Team::findOrFail($id);
        $leader = Employee::findOrFail($team->leader);
        $project = Project::findOrFail($team->project);
        $team->leader = $leader->name;
        $team->project = $project->name; 
        return view("admin.members", compact("team"))->with(compact("employees"));
    }

    public function addmember(Request $request) {
        $request->validate([
            'employee' => ['required'],
        ]);
        $member = Member::create([
            "team" => $request->team_id,
            "employee" => $request->employee,
        ]);

        $member->save;

        return back()->with("message", "Member added successfully");
    }

    public function showmembers(int $id) {
        $members = Member::where("team", $id)->get()->pluck("employee");
        $employees = Employee::whereIn("id", $members)->get();

        $team = Team::findOrFail($id);
        $leader = Employee::findOrFail($team->leader);
        $project = Project::findOrFail($team->project);
        $team->leader = $leader->name;
        $team->project = $project->name; 
        return view("admin.showmembers", compact("team"))->with(compact("employees"));
    }

    public function removemember(int $id) {
        $member = Member::where("employee", $id);
        $member->delete();
        return back();
    }
}
