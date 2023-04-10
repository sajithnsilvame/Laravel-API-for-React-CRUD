<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'student' => $students
        ],200);
  
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $studentData = $request->all();

        $validate = Validator::make($studentData, [
            'name' => 'required',
            'cource' => 'required',
            'email' => 'required|email',
            //'phone' => 'required|digits:10|unique'
        ]);

        if($validate->fails())
        { 
            return response()->json([
                'status' => 422,
                'errors' => $validate->messages()
            ],422);
        }
        else
        {
            $student = Student::create($studentData);
            
            if($student)
            {
                return response()->json([
                'status' => 200,
                'message' => 'student data was created',
                ],200);
            }
            else
            {
                return response()->json([
                'status' => 500,
                'message' => 'something went wrong!'
                ],500);
            }
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Employee::findOrFail($id);
        if($student){
            return response()->json([
            'status' => 200,
            'student' => $student
        ],200);
        }
        else{
            return response()->json([
            'status' => 404,
            'message' => 'Not Found'
        ],404);
        }
    }

    public function edit(string $id)
    {
        $student = Student::find($id);
        
        if($student)
        {
            return response()->json([
               'status' => 200,
               'student' => $student 
            ],200);
        }
        else{
            return response()->json([
               'status' => 404,
               'message' => 'student not found'     
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        
        if($student){
            
            $student->name = $request->name;
            $student->cource = $request->cource;
            $student->email = $request->email;
            
            $student->save();

            return response()->json([
            'status' => 200,
            'message' => 'data was updated',
            'employee' => $student
            ],200);
        }
        else{
            
            return response()->json([
            'status' => 404,
            'message' => 'No found such student',
            ],404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
               'status' => 200,
               'message' => 'data was deleted' 
            ],200);
        }
        else{
            return response()->json([
               'status' => 404,
               'message' => 'data was deleted' 
            ],404);
        }
    }
}