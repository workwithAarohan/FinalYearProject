<?php

namespace App\Http\Traits;

use App\Models\Classroom;
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

        // echo($semester->semester_name . "<br>");

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

                        // echo($classroom->room_name . "<br>");
                        $classroom_attendance = ClassroomEvaluationTraits::StudentAttendanceEvaluation($classroom, $student);

                        $attendance = $attendance + $classroom_attendance;

                        // echo($classroom_attendance. "--- " . $classroom->room_name . "<br>");
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


        // echo($overall . "<br>");

        return $overall;
    }

    public static function OverallAssignment(Semester $semester, Student $student)
    {
        $batch_id = $student->batch->id;

        $assignment = 0;

        // echo($semester->semester_name . "<br>");

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

                        // echo($classroom->room_name . "<br>");
                        $classroom_assignment = ClassroomEvaluationTraits::StudentAssignmentEvaluation($classroom, $student);

                        $assignment = $assignment + $classroom_assignment;

                        // echo($classroom_assignment. "--- " . $classroom->room_name . "<br>");
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


        // echo($overall . "<br>");

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
                    $result = Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('examination_id', $exam->id)->first();

                    $total += $result->marks_obtained;
                    $full_marks += $subject->pivot->full_mark;
                }
                $percentage = round(($total/$full_marks) * 100,2);
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


}
