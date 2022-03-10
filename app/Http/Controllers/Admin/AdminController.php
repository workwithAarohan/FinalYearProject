<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Traits\StudentPerformanceTraits;

class AdminController extends Controller
{
    use StudentPerformanceTraits;

    public function listOfStudents(Request $request)
    {

        if($request->has('course_id'))
        {
            $request->validate([
                'course_id' => 'required',
                'batch_id' => 'required'
            ]);
            $students = Student::where('course_id', $request->course_id)
                                ->where('batch_id', $request->batch_id)
                                ->get();

            $course = Course::find($request->course_id);
            $batch = Batch::find($request->batch_id);
        }
        else
        {
            $students = [];
            $course = [];
            $batch = [];
        }

        return view('admin.student', [
            'courses' => Course::all(),
            'students' => $students,
            'faculty' => $course,
            'batch' => $batch,
        ]);
    }

    public function selectBatch($course)
    {
        $batches = Batch::where('course_id', $course)->get();

        return response()->json($batches);
    }

    public function studentPerformance(Student $student)
    {
        $semesters = Semester::all();
        foreach($semesters as $semester)
        {
            $semester->attendance = StudentPerformanceTraits::OverallAttendance($semester, $student);
            $semester->assignment = StudentPerformanceTraits::OverallAssignment($semester, $student);
        }
        return view('admin.students.performance', [
            'semesters' => $semesters,
            'student' => $student
        ]);
    }
}
