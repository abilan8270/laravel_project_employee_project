<?php

use App\Http\Controllers\Employeecontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Empoloyee routes
//indax page
Route::get('/employees',[Employeecontroller::class,'index'])->name('employee.index');

//create page
Route::get('/employees/create',[Employeecontroller::class,'create'])->name('employee.create');

// store page
Route::post('/employees/store',[Employeecontroller::class,'store'])->name('employee.store');

// show
Route::get('/employees/{employee}',[EmployeeController::class,'show'])->name('employee.show');

//update
Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employee.update'); 

//show
Route::get('/employees/{employee}',[EmployeeController::class,'show'])->name('employee.show');

//edit
Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employee.edit');

//update
Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employee.update');

// delete
Route::delete('/employees/{employee}',[EmployeeController::class,'destroy'])->name('employee.destroy');