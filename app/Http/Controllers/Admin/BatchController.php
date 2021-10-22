<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Batch;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM batch;
      
        // $batches = Batch::all();

        return view('admin.batch.index', [
            'batches' => Batch::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.batch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Batch::create($request->all());

        $request->session()->flash('success','You have create new batch');

        return redirect('admin/batch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        // List of all students in a same batch

        $students = $batch->users()->paginate(10);

        // Inner join between student_information, user and course
        // foreach ($students as $key => $value)
        // {

        //     $usersCourse = DB::table('student_information')
        //         ->join('users', 'student_information.user_id', '=', 'users.id')
        //         ->join('courses', 'student_information.course_id', '=', 'courses.id')
        //         ->where('users.id', $value->user_id)
        //         ->get();

        //     $value->users = $usersCourse;

        //     // Users Information
        //     // $users = User::where('id', $value->user_id)->get();
        //     // $value->users = $users;
        // }


       return view('admin.batch.show',[
           'batch' => $batch,
           'students' => $students
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        return view('admin.batch.edit', [
            'batch' => $batch
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);


        $batch->update($request->all());

        $request->session()->flash('success','You have updated the batch');

        return redirect('admin/batch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch, Request $request)
    {
        $batch->delete();

        $request->session()->flash('success','You have deleted the batch');

        return redirect('admin/batch');
    }
}
