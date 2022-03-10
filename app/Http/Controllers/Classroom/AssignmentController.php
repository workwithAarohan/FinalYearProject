<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Traits\ClassroomEvaluationTraits;
use App\Models\Assignment;
use App\Models\AssignmentPoint;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    use ClassroomEvaluationTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        return view('coordinator.classroom.assignment.index', [
            'classroom' => $classroom
        ]);
    }

    /**
     * Student Assignment Evaluation
     *
     */
    public function studentAssignmentEvaluation(Classroom $classroom)
    {
        $classroom->percent = ClassroomEvaluationTraits::studentAssignmentEvaluation($classroom, auth()->user()->student);


        return view('coordinator.classroom.assignment.studentWork.show',[
            'classroom' => $classroom,
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
        $request->validate([
            'title' => 'required',
            'points' => 'required',
        ]);

        $assignment = DB::transaction(function () use ($request) {

            $assignment = Assignment::create($request->all());

            foreach($assignment->classroom->students as $student)
            {
                AssignmentPoint::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'classroom_id' => $assignment->classroom->id
                ]);
            }

            return $assignment;
        });

        return redirect('/classroom/assignment/'. $assignment->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {

        return view('coordinator.classroom.assignment.show', [
            'assignment' => $assignment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        return view('coordinator.classroom.assignment.edit', [
            'assignment' => $assignment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required',
            'points' => 'required',
        ]);

        $assignment->update($request->all());

        return redirect('/classroom/assignment/'. $assignment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect('/classroom/'. $assignment->classroom_id .'/assignment');
    }
}
