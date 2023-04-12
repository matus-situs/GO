<?php

namespace App\Providers;

use App\Interfaces\EmployeeInterface;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class ProviderRepository extends ServiceProvider{
    public function register() {
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
    }

    public function boot()
    {
        $this->register();
    }
}