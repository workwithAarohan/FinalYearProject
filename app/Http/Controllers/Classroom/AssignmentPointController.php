<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentPoint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Assignment $assignment)
    {
        $checkedCount = DB::table('assignment_student')
            ->where('assignment_id' ,$assignment->id)
            ->where('is_checked', 1)
            ->count();
        return view('coordinator.classroom.assignment.studentWork.index', [
            'assignment' => $assignment,
            'checkedCount' => $checkedCount,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentPoint  $assignmentPoint
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentPoint $studentWork)
    {
        return view('coordinator.classroom.assignment.studentWork.show',[
            'studentWork' => $studentWork,
            'student' => auth()->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentPoint  $assignmentPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentPoint $assignmentPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignmentPoint  $assignmentPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentPoint $assignmentPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentPoint  $assignmentPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentPoint $assignmentPoint)
    {
        //
    }
}
