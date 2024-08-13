<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'name' => 'required|string',
            'univ' => 'required|string'
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nim' => 'required|string',
            'name' => 'required|string',
            'univ' => 'required|string'
        ]);

        $student = Student::find($id);

        if ($student) {
            $student->update($validated);
            return response()->json($student);
        }

        return response()->json(['error' => 'Student not found'], 404);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted']);
        }

        return response()->json(['error' => 'Student not found'], 404);
    }
}
