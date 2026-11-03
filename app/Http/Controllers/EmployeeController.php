<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all employees & eager load managers and departments
        
        $employees = Employee::with(['department', 'manager'])
            ->orderBy('name')
            ->paginate(7);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return create view, departments, and managers

        return view('employees.create', [
            'departments' => Department::orderBy('name')->get(),
            'managers' => Employee::orderBy('name')->whereNull('manager_id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')->with('success', 'Employee added');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::orderBy('name')->get(),
            'managers' => Employee::orderBy('name')->whereNull('manager_id')->whereKeyNot($employee->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index')->with('success', 'Employee updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Employee $employee)
    {
        if ($employee->directReports()->exists()) {
        return back()->with('error', "Reassign {$employee->name}'s team before offboarding them.");
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee offboearded');
    }
}
