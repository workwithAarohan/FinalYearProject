<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewStudentAdmissionEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\StudentEnrollment;

use App\Models\User;
use App\Models\Batch;
use App\Models\Role;

class StudentController extends Controller
{
    public function index()
    {

        return view('admin.students.index',[
            'students' => User::paginate(10)
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

        $student = User::create($request->all());

        // Insert into user_role table
        $student->roles()->sync($request->roles);

        // select admin to notify
        $user = User::find(1);

        event(new NewStudentAdmissionEvent($student,$user));

        return redirect('/');
    }

    public function show($id)
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }
}

