<?php

namespace App\Http\Traits;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

trait ClassroomEvaluationTraits
{
    public static function CourseCompleted(Classroom $classroom)
    {
        if($classroom->topics->count()!=0)
        {
            $totalCreditHrs =  DB::table('topics')->where('classroom_id', $classroom->id)->sum('credit_hrs');

            $totalTopicCompleted = 0;

            foreach($classroom->topics as $topic)
            {
                $noOfSubTopicCompleted = $topic->subTopics->where('is_completed', 1)->count();
                $totalNoOfSubTopics = $topic->subTopics->count();

                $topicCompleted = ($noOfSubTopicCompleted/$totalNoOfSubTopics) * $topic->credit_hrs;

                $totalTopicCompleted = $totalTopicCompleted + $topicCompleted;
            }

            $courseCompleted = round(($totalTopicCompleted/$totalCreditHrs) * 100);
        }
        else
        {
            $courseCompleted = 0;
        }

        return $courseCompleted;
    }

    public static function StudentAssignmentEvaluation(Classroom $classroom, Student $student)
    {
        if($classroom->assignments->count()!=0)
        {
            $totalPointsObtained = 0;
            $totalAssignmentPoints = 0;

            foreach($classroom->assignments as $assignment)
            {
                $count = 0;
                foreach ($assignment->student_points as $student_point)
                {
                    if ($student_point->student->id == $student->id && $student_point->pointsObtained != null)
                    {
                        $totalPointsObtained= $totalPointsObtained + $student_point->pointsObtained;
                        $count++;
                    }
                }
                if($count == 1)
                {
                    $totalAssignmentPoints = $totalAssignmentPoints + $assignment->points;
                }
            }

            if($totalAssignmentPoints!=0)
            {
                $assignmentPercent = round(($totalPointsObtained/$totalAssignmentPoints)*100,2);
            }
            else
            {
                $assignmentPercent = 0;
            }

        }

        else
        {
            $assignmentPercent = 0;
        }

        return $assignmentPercent;

    }

    public static function StudentAttendanceEvaluation(Classroom $classroom, Student $student)
    {
        if($classroom->attendances->count() != 0)
        {
            $totalAttendance = $classroom->attendances->count();

            $totalPresentCount = 0;

            foreach($classroom->attendances as $attendance)
            {
                $totalPresent = DB::table('attendance_student')
                    ->where('attendance_id', $attendance->id)
                    ->where('student_id', $student->id)
                    ->where('status', 'Present')
                    ->count();

                $totalPresentCount += $totalPresent;
            }

            $attendancePercent = round(($totalPresentCount/$totalAttendance) * 100);

        }
        else
        {
            $attendancePercent = 0;
        }

        return $attendancePercent;
    }

}
