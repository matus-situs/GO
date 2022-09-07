<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AddProjectsController extends Controller
{
    public function index() {
        $leaders = Employee::where("role", "team leader")->get();
        return view("admin.addproject", compact("leaders"));
    }
}
