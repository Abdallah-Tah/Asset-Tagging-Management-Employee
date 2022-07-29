<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AmazonSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $sites = AmazonSite::all();
        return view('employees.index', compact('employees', 'sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:6|confirmed',
            'amazon_site_id' => 'required|string|max:255',
        ])->validate(); */

        $sites = json_encode($request->amazon_site_id);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->amazon_site_id = $sites;
        $employee->user_id = Auth::user()->id;
        $employee->save();

        $employee->amazonSite()->sync($request->amazon_site_id);


        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee = Employee::find($employee->id);
        $sites = AmazonSite::all();
        return view('employees.profile', compact('employee', 'sites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'amazon_site_id' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $sites = json_encode($request->amazon_site_id);
        $employee = Employee::find($employee->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->amazon_site_id = $sites;
        $employee->user_id = Auth::user()->id;
        $employee->update();
        $employee->amazonSite()->sync($request->amazon_site_id);
        return redirect()->route('employees.index')->session()->flash('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    /**
     * Display a listing of the resource for Profil employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $employee = Employee::find($id);
        $sites = AmazonSite::all();
        return view('employees.profile', compact('employee', 'sites'));
    }
}
