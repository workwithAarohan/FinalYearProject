<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewStudentAdmissionEvent;
use App\Http\Controllers\Controller;
use App\Http\Traits\EvaluationTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\StudentEnrollment;

use App\Models\User;
use App\Models\Batch;
use App\Models\Role;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use EvaluationTraits;

    public function index()
    {

        return view('admin.students.index',[
            'students' => Student::paginate(10)
        ]);
    }

    public function create()
    {
        $roles = Role::where('name','=','Student')->select('id')->get();

        return view('admin.students.create',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'username' => strtolower($request->firstname) . "@academia",
        ]);

        DB::transaction(function () use ($request) {
            // Create new Student
            $student = User::create($request->all());

            // Insert into user_role table
            $student->roles()->sync($request->roles);

            // Select admin to notify
            $user = User::find(1);

            // Call New Student Admission Event
            event(new NewStudentAdmissionEvent($student,$user));
        });


        return redirect('/');
    }

    public function show($id)
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }

    public function dashboard()
    {
        $student = User::findOrFail(auth()->user()->id)->student;

        $classrooms = $student->classrooms;

        foreach($classrooms as $classroom)
        {
            $classroom->courseCompleted = EvaluationTraits::CourseCompleted($classroom);
        }

        return view('student.dashboard', [
            'student' => $student,
            'classrooms' => $classrooms
        ]);
    }
}

