<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use App\Http\Requests\StudentCreateFormValidate;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  
    public function index()
    {
        $students = Student::orderBy('id','desc')->get();
        return view('student.index',compact('students'));
    }

    public function create(){}

    public function store(StudentCreateFormValidate $request)
    {
        $data = Student::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'cell'=>$request->cell,
          'gender'=>$request->gender,
          'monthly_donation'=>$request->monthly_donation,
          'created_at'=>Carbon::now()
        ]);
        return response()->json($data);
    }

    public function show(Student $student){}

    public function edit(Student $student){}

    public function update(Request $request, Student $student){}

    public function destroy(Student $student){}
}
