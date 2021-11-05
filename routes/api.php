<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix'=>'employee'],function () {
    Route::get('/',[EmployeeController::class,'index']);
    Route::post('/',[EmployeeController::class,'store']);

    Route::get('/{id}',[EmployeeController::class,'show']);
    Route::put('/{id}',[EmployeeController::class,'update']);
    Route::delete('/{id}',[EmployeeController::class,'destroy']);
});

// Route::apiResource('employee',EmployeeController::class)->only('index','store','show','update','destroy');