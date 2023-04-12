<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeInterface {
    public function getAll()
    {
        return Employee::paginate();
    }
    public function findByKey($key, $value) {
        return Employee::where($key, $value)->first();
    }
    public function findByVacation($vacation){
        return Employee::findOrFail($vacation->employee);
    }
}