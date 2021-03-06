<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Semester;

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
    public function create(Course $course)
    {
        return view('admin.batch.create',[
            'course' => $course
        ]);
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
            'batch_name' => 'required|string|max:255',
            'batch_description' => 'required|string|max:255',
            'year' => 'required|string|max:255'
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

       return view('admin.batch.show',[
           'batch' => $batch,
           'students' => $students,
           'semesters' => Semester::all()
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
            'batch_name' => 'required|string|max:255',
            'batch_description' => 'required|string|max:255',
            'year' => 'required|string|max:255'
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
