<?php

namespace App\Interfaces;

interface EmployeeInterface {
    public function getAll();
    public function findByKey($key, $value);
    public function findByVacation($vacation);
}