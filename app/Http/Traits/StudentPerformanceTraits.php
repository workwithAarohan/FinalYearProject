<?php

namespace App\Http\Traits;

use App\Models\Examination;
use App\Models\Result;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

trait StudentPerformanceTraits
{
    public static function OverallAttendance(Semester $semester, Student $student)
    {
        $batch_id = $student->batch->id;

        $attendance = 0;

        $count = 0;

        if(count($semester->subjects))
        {
            foreach($semester->subjects as $subject)
            {
                $totalClassrooms = $subject->batch_classrooms($batch_id)->count();

                if($totalClassrooms>0)
                {
                    foreach($subject->batch_classrooms($batch_id)->get() as $classroom)
                    {
                        $classroom_attendance = ClassroomEvaluationTraits::StudentAttendanceEvaluation($classroom, $student);

                        $attendance = $attendance + $classroom_attendance;
                    }

                    $count++;

                }
            }

            if($count !=0 )
            {
                $overall = round(($attendance / $count), 2);
            }

            else
            {
                $overall = 0;
            }
        }

        else
        {
            $overall = 0;
        }

        return $overall;
    }

    public static function OverallAssignment(Semester $semester, Student $student)
    {
        $batch_id = $student->batch->id;

        $assignment = 0;

        $count = 0;

        if(count($semester->subjects))
        {
            foreach($semester->subjects as $subject)
            {
                $totalClassrooms = $subject->batch_classrooms($batch_id)->count();

                if($totalClassrooms>0)
                {
                    foreach($subject->batch_classrooms($batch_id)->get() as $classroom)
                    {
                        $classroom_assignment = ClassroomEvaluationTraits::StudentAssignmentEvaluation($classroom, $student);

                        $assignment = $assignment + $classroom_assignment;
                    }

                    $count++;

                }
            }

            if($count !=0 )
            {
                $overall = round(($assignment / $count), 2);
            }

            else
            {
                $overall = 0;
            }

        }

        else
        {
            $overall = 0;
        }

        return $overall;
    }

    public static function OverallExamination(Semester $semester, Student $student)
    {
        $batch_id = $student->batch->id;
        $course_id = $student->course->id;

        $exams = Examination::where('batch_id', $batch_id)
                ->where('course_id', $course_id)
                ->where('semester_id', $semester->id)
                ->get();

        $count = $exams->count();
        $overall_percentage = 0;

        if($count != 0)
        {
            foreach($exams as $exam)
            {
                $total = 0;
                $full_marks = 0;
                foreach($exam->subjects as $subject)
                {
                    if($subject->pivot->is_checked)
                    {
                        $result = Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('examination_id', $exam->id)->first();

                        $total += $result->marks_obtained;
                        $full_marks += $subject->pivot->full_mark;
                    }
                }
                if($full_marks!=0)
                {
                    $percentage = round((($total/$full_marks) * 100),1);
                }
                else
                {
                    $percentage = 0;
                }
                $overall_percentage += $percentage;
            }
            $overall_percentage /= $count;
        }

        else
        {
            $overall_percentage = 0;
        }

        return $overall_percentage;
    }

    public static function OverallPerformance(Semester $semester, Student $student)
    {
        $attendancePercentage = StudentPerformanceTraits::OverallAttendance($semester, $student);
        $assignmentPercentage = StudentPerformanceTraits::OverallAssignment($semester, $student);
        $internalExamPercentage = StudentPerformanceTraits::OverallExamination($semester, $student);

        // echo($attendancePercentage ."<br>" . $assignmentPercentage ."<br>" . $internalExamPercentage ."<br>");


        $boards = DB::table('education_student')
            ->where('course_id', $student->course_id)
            ->where('batch_id', $student->batch_id)
            ->where('semester_id', $semester->id)
            ->select('percentage')
            ->first();

        $overall = (40 * $internalExamPercentage + 40 * $boards->percentage + 10 * $attendancePercentage + 10 * $assignmentPercentage)/ 100 ;


        // echo($overall ."<br>");
        // echo("--------------------- <br>");

        return $overall;
    }


}
