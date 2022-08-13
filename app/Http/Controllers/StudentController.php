<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::get();
        return view('students.index', [
            'students' => $students,
        ]);
    }
    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {
        $student =  new Student();
        $student->first_name = $request->get('first_name');
        $student->last_name = $request->get('last_name');
        $student->gender = $request->get('gender');
        $student->birthdate = $request->get('birthdate');
        $student->save();
    }
}
