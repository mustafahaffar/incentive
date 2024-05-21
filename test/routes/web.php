
<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManegerController;
use App\Http\Controllers\TargetController;
use App\Models\Maneger;
use Illuminate\Support\Facades\Route;

//login
Route::get('/login', [ManegerController::class, 'login']);

Route::middleware('Check')->group(function(){
    //logout
    Route::get('/out', [ManegerController::class, 'out']);

    //password change
    Route::post('/password/change', [ManegerController::class, 'password_change']);

    //put target value
    Route::post('/target', [TargetController::class, 'target_value']);

    //create new employee
    Route::post('/create', [EmployeeController::class, 'create']);

    //update employee details
    Route::post('/update', [EmployeeController::class, 'update']);

    // update employee status
    Route::post('/update/status', [EmployeeController::class, 'update_status']);

    //delete employee
    Route::delete('/delete', [EmployeeController::class, 'delete']);

    //get employee details
    Route::get('/get', [EmployeeController::class, 'get']);
});