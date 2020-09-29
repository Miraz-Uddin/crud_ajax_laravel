<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use App\Http\Requests\StudentCreateFormValidate;
use App\Http\Requests\StudentUpdateFormValidate;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::orderBy('id','desc')->get();
        return view('student.index',compact('students'));
    }

    public function getStudentsData(){
        $userData = Student::orderBy('id','desc')->get();
        return json_encode(array('data'=>$userData));
    }

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

    public function edit($id){
      $student = Student::where('id',$id)->get();

      if($student){
          return response()->json($student,200);
      }else{
          return response()->json('Student Not Found');
      }
    }

    public function create(){}

    public function show(Student $student){}

    public function update(StudentUpdateFormValidate $request, $student_id){
      $student = Student::find($student_id)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'cell'=>$request->cell,
        'gender'=>$request->gender,
        'monthly_donation'=>$request->monthly_donation,
      ]);
      return response()->json($student);
    }

    public function destroy(Student $student){}
}
