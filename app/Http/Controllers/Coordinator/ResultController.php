<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Examination $examination, Subject $subject)
    {
        // $results = Result::where('examination_id', $examination->id)->where('subject_id', $subject->id)->get();

        $value = DB::table('examination_subject')->where('examination_id', $examination->id)->where('subject_id', $subject->id)->first();
        $results = Result::where('examination_id', $examination->id)->where('subject_id', $subject->id)->get();

        return view('coordinator.result.index', [
            'examination' => $examination,
            'subject' => $subject,
            'value' => $value,
            'results' => $results,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->students as $student)
        {
            $result = Result::where('examination_id', $request->examination_id)->where('subject_id', $request->subject_id)->where('student_id', $student)->first();

            $result->update([
                'marks_obtained' => $request->marks_obtained[$student]
            ]);
        }

        $request->session()->flash('success','Marks Updated');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
