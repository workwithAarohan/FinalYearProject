<?php

namespace App\Http\Controllers\Admin;

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

        $student = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => strtolower($request->input('firstname')).'-'.strtolower($request->input('lastname')),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            'temporaryAddress' => $request->input('temporaryAddress'),
            'permanentAddress' => $request->input('permanentAddress'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'nationality' => $request->input('nationality'),
        ]);
        $student->roles()->sync($request->roles);

        $user = User::find(1);
        $user->notify(new StudentEnrollment($student));

        return redirect('/');
    }

    public function show($id)
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }
}

