<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // show method
    public function show(Employee $employee)
    {
        $employee->load([
            'banjar',
            'gender',
            'lastEducation',
            'religion',
            'occupation',
            'maritalStatus',
            'employmentUnit',
            'employeeLevel',
            'contacts.contactType',
        ]);

        return view('employee.show', compact('employee'));
    }
}
