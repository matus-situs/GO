<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Interfaces\EmployeeInterface;
use App\Repositories\EmployeeRepository;

class EmployeesController extends Controller
{
    /*
    *@return \Illuminate\Http\Response
    */
    protected $employeeInterface;

    public function __construct(EmployeeInterface $employeeRepository)
    {
        $this->employeeInterface = $employeeRepository;
    }

    public function index() {
        $employees = $this->employeeInterface->getAll();

        return view("admin.employeelist", compact("employees"));
    }
    public static function edit(Employee $employee) {
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
        $user = $this->employeeInterface->findByKey('email',  $request->input("email"));
        $user->role = $request->input("role");
        $user->save();

        return back()->with("message", "User updated successfully");
    }
}
