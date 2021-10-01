<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }

    public function create($id)
    {
        return view('admin.students.create',[
            'batch' => Batch::findOrFail($id)
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

        return redirect(route('batch.show'));
    }

    public function show()
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }
}

