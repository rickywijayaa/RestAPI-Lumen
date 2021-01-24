<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $student = Student::all();

        return response()->json([$student],200);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'No Student with this Id'],404);
        }

        return response()->json($student);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required',
            'number' => 'required',
        ]);

        $data = $request->all();
        $student = Student::create($data);

        return response()->json($student);
    }

    public function update(Request $request,$id)
    {
        $student = Student::find($id);

        if(!$student)
        {
            return response()->json(['message' => 'Student Not Found']);
        }

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
        ]);

        $data = $request->all();
        $student->update($data);

        return response()->json(['message' => 'Update Success',$student],200);
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message'=> 'Theres no student with this ID'],404);
        }

        $student->delete();

        return response()->json(['message' => 'Delete Success'],200);
    }
}
