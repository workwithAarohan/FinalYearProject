<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();

        return view('batch.index', [
            'batches' => $batches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $batch = new Batch();

        request()->validate([
            'name' => 'required|string|max:255'
        ]);

        $batch->create([
            'name' => $request->input('name')
        ]);

        return redirect('/batch');
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

        $students = $batch->users;

        foreach ($students as $key => $value) 
        {
            $users = User::where('id', $value->user_id)->get();
            $value->users = $users;
        }


       return view('batch.show',[
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
        return view('batch.edit', [
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
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $batch->update([
            'name' => $request->input('name')
        ]);

        return redirect('/batch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect('/batch');
    }
}
