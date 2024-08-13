<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::with('division')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'divisions_id' => 'required|exists:divisions,id',
            'image' => 'nullable|url'
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'divisions_id' => 'required|exists:divisions,id',
            'image' => 'nullable|url'
        ]);

        $employee = Employee::find($id);

        if ($employee) {
            $employee->update($validated);
            return response()->json($employee);
        }

        return response()->json(['error' => 'Employee not found'], 404);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();
            return response()->json(['message' => 'Employee deleted']);
        }

        return response()->json(['error' => 'Employee not found'], 404);
    }
}
