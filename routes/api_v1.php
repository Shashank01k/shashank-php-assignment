<?php

use App\Http\Controllers\api\v1\TaskAssignController;
use App\Http\Controllers\api\v1\TaskCreateController;
use App\Http\Controllers\api\v1\TaskDeleteController;
use App\Http\Controllers\api\v1\TaskStatusChangeController;
use App\Http\Controllers\api\v1\TaskUnAssignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserLoginController;
use App\Http\Controllers\api\v1\UserSeederController;
use App\Http\Controllers\api\v1\UserViewController;
use App\Http\Controllers\api\v1\UserSearchController;
use App\Http\Controllers\api\v1\TaskUpdateController;

Route::post('login', [UserLoginController::class,'login']);
Route::get('/run_seeder/{count?}',[UserSeederController::class,'runSeeder']);
Route::get('/delete_seeder_data/{id?}',[UserSeederController::class,'deleteSeederData']);

// echo "test route file::"; die;
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('view', [UserViewController::class,'view']);
    Route::get('/view/{id}', [UserViewController::class,'byId']);

    Route::get('/search/{name?}', [UserSearchController::class,'search']);
    Route::post('/create_user', [TaskCreateController::class,'create']);

    Route::put('/update/{id?}', [TaskUpdateController::class,'updateTask']);
    Route::put('/change_task_status/{id?}', [TaskStatusChangeController::class,'changeTaskStatus']);

    Route::post('/create', [TaskCreateController::class,'createTask']);
    Route::delete('/delete/{id?}', [TaskDeleteController::class,'deleteTask']);

    Route::post('/assign_task', [TaskAssignController::class,'assignTask']);
    Route::post('/unassign_task/{id?}', [TaskUnAssignController::class,'unAssignTask']);

    Route::post('/logout',[UserLoginController::class,'logout']);
});