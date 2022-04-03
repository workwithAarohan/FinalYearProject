<?php

namespace App\Http\Controllers;

use App\Http\Traits\StudentPerformanceTraits;
use App\Models\Batch;
use App\Models\Semester;
use Illuminate\Support\Facades\DB;

class StudentPerformanceController extends Controller
{
    use StudentPerformanceTraits;

    public function ScholarshipEvaluation(Semester $semester, Batch $batch)
    {
        foreach($batch->students as $student)
        {
            $student->attendancePercentage = StudentPerformanceTraits::OverallAttendance($semester, $student);
            $student->assignmentPercentage = StudentPerformanceTraits::OverallAssignment($semester, $student);
            $student->internalExamPercentage = StudentPerformanceTraits::OverallExamination($semester, $student);

            $boards = DB::table('education_student')
                ->where('course_id', $student->course_id)
                ->where('batch_id', $student->batch_id)
                ->where('semester_id', $semester->id)
                ->select('percentage')
                ->first();

            $student->boardPercentage = $boards->percentage;

            $student->overall = (40 * $student->internalExamPercentage + 40 * $student->boardPercentage + 10 * $student->attendancePercentage + 10 * $student->assignmentPercentage)/ 100 ;
        }

        $students = $batch->students->sortByDesc(function($rank){
            return $rank->overall;
        });

        $topper = $students->splice(0,1)->first();

        return view('student.scholarship', [
            'semester' => $semester,
            'students' => $students,
            'batch' => $batch,
            'topper' => $topper,
        ]);
    }
}
