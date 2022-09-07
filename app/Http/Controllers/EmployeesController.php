<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    /*
    *@return \Illuminate\Http\Response
    */
    public function index() {
        $employees = Employee::paginate();

        return view("admin.employeelist", compact("employees"));
    }
    public static function edit(int $id) {
        $employee = Employee::findOrFail($id);
        return view("admin.editemployee", compact("employee"));
    }
    public function update(Request $request) {
        $request->validate([
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'vacation' => ['int'],
            'role' => ['required', 'string'],
        ]);
        $user = Employee::where('email',  $request->input("email"))->first();
        $user->role = $request->input("role");
        $user->save();

        return back()->with("message", "User updated successfully");
    }
}
