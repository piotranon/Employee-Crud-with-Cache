<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @group Employee
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response 200
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $employees = Cache::get('all-employees');

        if(empty($employees))
        {
            $employees = Employee::all();
            Cache::put('all-employees',$employees,60*60);//1h
        }

        return response()->json($employees);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @response 200
     * @response 422
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $employee = new Employee($request->validated());
        $employee->save();

        Cache::forget('all-employees');

        return response()->json();
    }

    /**
     * Display the specified resource.
     * 
     * @response 200
     * @response 404 {
    "message": "No query results for model [App\\Models\\Employee]."
}
     * @response 422 {
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "last_name": [
            "The last name field is required."
        ],
        "position": [
            "The position field is required."
        ],
        "salary": [
            "The salary field is required."
        ]
    }
}
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Cache::get('employee-'.$id);

        if(empty($employee))
        {
            $employee = Employee::where('id',$id)->firstOrFail();
            Cache::put('employee-'.$id,$employee,60*60);//1h
        }

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @response 200
     * @response 404 {
    "message": "No query results for model [App\\Models\\Employee]."
}
     * @response 422 {
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "last_name": [
            "The last name field is required."
        ],
        "position": [
            "The position field is required."
        ],
        "salary": [
            "The salary field is required."
        ]
    }
}
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployee $request, $id)
    {
        $employee = Employee::where('id',$id)->firstOrFail();
        $employee->update($request->validated());

        $cache = Cache::get('employee-'.$id);

        if(!empty($cache))
        {
            Cache::forget('employee-'.$id);
        }

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @response 200
     * @response 404 {
    "message": "No query results for model [App\\Models\\Employee]."
}
     * 
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        Cache::forget('employee-'.$id);
        Cache::forget('all-employees');
        
        return response()->json();
    }
}
