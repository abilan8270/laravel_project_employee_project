<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class Employeecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id','desc')->paginate(2);
        return view('index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email|email',
            'joining_date' => 'required',
            'phone' => 'required|numeric|unique:employees,phone',
            'salary' => 'required',
        ],[
           'phone.unique' => 'Phone number already exist' 
        ]);
        $data = $request->except('_token');
         // Mass assigment
         Employee::create($data);


        return redirect()->route('employee.index')->withSuccess('Employee has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email,'.$employee->id.'|email',
            'joining_date' => 'required',
            'phone' => 'required|numeric|unique:employees,phone,'.$employee->id,
            'salary' => 'required',
        ],[
           'phone.unique' => 'Phone number already exist' 
        ]);
        
        $data = $request->all();
        $employee->update($data);
        return redirect()->route('employee.edit',$employee->id)
        ->withSuccess('Employee details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
        ->withSuccess('Employee deleted successfully');
    }
}
