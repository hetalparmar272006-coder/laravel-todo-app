<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'message'=>'Student list fetched successfully','data'=>Student::all()]);
    }
    public function store(Request $request)
    {
        $student - Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ]);
    }
}
