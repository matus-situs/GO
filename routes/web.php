<?php

use App\Http\Controllers\AddEmployeeControler;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
Route::group(["middleware" => "auth"], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name("dashboard");

    Route::group(["middleware" => "admin"], function () {
        Route::view("addemployee", "admin.addemployee")->name("addemployee");
        Route::post("addemployee", [\App\Http\Controllers\AddEmployeeControler::class, "post"])->name("addemployee.add");

        Route::get("employeelist/{id}/edit", "\App\Http\Controllers\EmployeesController@edit");
        Route::resource("employeelist", \App\Http\Controllers\EmployeesController::class);
        Route::put("employeelist", [\App\Http\Controllers\EmployeesController::class, "update"])->name("employeelist.update");

        Route::resource("projects", \App\Http\Controllers\ProjectsController::class);
        Route::resource("addproject", \App\Http\Controllers\AddProjectsController::class);
        Route::post("addproject", [\App\Http\Controllers\ProjectsController::class, "post"])->name("projects.add");

        Route::get("teams/{id}/removemember", "\App\Http\Controllers\TeamsController@removemember")->name("teams.removemember");
        Route::get("teams/{id}/showmembers", "\App\Http\Controllers\TeamsController@showmembers")->name("teams.showmembers");
        Route::get("teams/{id}/members", "\App\Http\Controllers\TeamsController@members")->name("teams.members");
        Route::get("teams/{id}/edit", "\App\Http\Controllers\TeamsController@edit")->name("teams.edit");
        Route::resource("teams", \App\Http\Controllers\TeamsController::class);
        Route::resource("addteams", \App\Http\Controllers\AddTeamsController::class);
        Route::post("addteams", [\App\Http\Controllers\TeamsController::class, "post"])->name("teams.add");
        Route::put("teams", [\App\Http\Controllers\TeamsController::class, "update"])->name("teams.update");
        Route::put("teams", [\App\Http\Controllers\TeamsController::class, "addmember"])->name("teams.addmember");

        Route::resource("employeesvacation", \App\Http\Controllers\VacationController::class);
    });

    Route::group(["middleware" => "employee"], function () {
        Route::resource("employeeteam", \App\Http\Controllers\EmployeeTeamController::class);
        Route::resource("employeeproject", \App\Http\Controllers\EmployeeProjectController::class);
        Route::view("newvacation", "employee.newvacation")->name("newvacation");
        Route::post("employeevacation", [\App\Http\Controllers\EmployeeVacationController::class, "request"])->name("employeevacation.request");
        Route::resource("myvacations", \App\Http\Controllers\EmployeeVacationController::class);
    });

    Route::group(["middleware" => "team leader"], function () {
        Route::resource("leaderteam", \App\Http\Controllers\TeamLeaderTeamController::class);
        Route::resource("leaderproject", \App\Http\Controllers\TeamLeaderProjectController::class);
        Route::resource("myvacationstl", \App\Http\Controllers\TeamLeaderVacationController::class);
        
        Route::view("newvacationtl", "employee.newvacation")->name("newvacationtl");
        Route::post("employeevacation", [\App\Http\Controllers\TeamLeaderVacationController::class, "request"])->name("employeevacation.request");

        Route::resource("pendingvacationteam", \App\Http\Controllers\PendingVacationTeamController::class);
        Route::get("pendingvacationteam/{id}/approve", "\App\Http\Controllers\PendingVacationTeamController@approve")->name("pending.approve");
        Route::get("pendingvacationteam/{id}/deny", "\App\Http\Controllers\PendingVacationTeamController@deny")->name("pending.deny");

        Route::resource("employeesonvacation", \App\Http\Controllers\EmployeesOnVacationController::class);
    });

    Route::group(["middleware" => "project leader"], function () {
        Route::resource("myproject", \App\Http\Controllers\ProjectLeaderProjectController::class);
        Route::resource("myvacationspl", \App\Http\Controllers\ProjectLeaderVacationsController::class);

        Route::view("newvacationpl", "employee.newvacation")->name("newvacationpl");
        Route::post("employeevacation", [\App\Http\Controllers\ProjectLeaderVacationsController::class, "request"])->name("employeevacation.request");

        Route::resource("pendingvacationproject", \App\Http\Controllers\PendingVacationProjectController::class);
        Route::get("pendingvacationteam/{id}/approve", "\App\Http\Controllers\PendingVacationProjectController@approve")->name("pendingpl.approve");
        Route::get("pendingvacationteam/{id}/deny", "\App\Http\Controllers\PendingVacationProjectController@deny")->name("pendingpl.deny");
    });
});
require __DIR__ . '/auth.php';
