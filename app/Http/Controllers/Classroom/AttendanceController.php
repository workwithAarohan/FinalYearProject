<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Traits\ClassroomEvaluationTraits;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use ClassroomEvaluationTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classroom $classroom)
    {
        return view('coordinator.classroom.attendance.index', [
            'classroom' => $classroom
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
            'topic_covered' => 'required|max:255',
            'attendance_date' => 'required',
        ]);

        $attendance = DB::transaction(function() use ($request){

            $syncData = array();

            foreach($request->students as $student)
            {
                $syncData[$student] = array('status' => $request->status[$student]);
            }

            $attendance = Attendance::create($request->all());

            $attendance->students()->sync($syncData);


            return $attendance;

        });

        return redirect()->route('attendance.show', $attendance->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        // Individual Attendance report
        foreach($attendance->students as $student)
        {
            $studentAttendance = DB::table('attendance_student')
                ->select('*')
                ->where('student_id', $student->id)
                ->where('attendance_id', $attendance->id)
                ->get();

            $student->status = $studentAttendance[0]->status;

            $student->attedancePercent = ClassroomEvaluationTraits::StudentAttendanceEvaluation($attendance->classroom, $student);
        }

        // Student Status Count
        $counts = DB::select(
            DB::raw(
                'SELECT status, count(*) as statusCount from attendance_student where attendance_id='. $attendance->id . ' group by status'
            )
        );
        $attendanceStatusCount = "";
        foreach($counts as $count)
        {
            $attendanceStatusCount .= "['" . $count->status . "', ". $count->statusCount ."],";
        }
        $attendanceStatusCount = rtrim($attendanceStatusCount, ',');

        return view('coordinator.classroom.attendance.show', [
            'attendance' => $attendance,
            'statusCount' => $attendanceStatusCount
        ]);
    }

    public function reterieveData(Request $request, Classroom $classroom)
    {
        $student = Student::find($request->id);

        $student->attedancePercent = ClassroomEvaluationTraits::StudentAttendanceEvaluation($classroom, $student);

        $output = '<div class="d-flex p-4 justify-content-between help" style="width: 900px;"><div class="student-profile d-flex"><img src="/images/profile/'.$student->user->avatar.'" style="width: 40px; border-radius: 50%;" class="me-3 img-thumbnail image"><div><h5 style="font-size: 19px;" class="fw-bold">'. $student->user->firstname.' ' .$student->user->lastname.'</h5><p style="margin-top: -10px; font-size: 13px;">'. $student->symbol_number.'</p></div></div><div><p style="font-size: 13px;">'. $student->attedancePercent.'%</p></div></div>';

        return response()->json($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
