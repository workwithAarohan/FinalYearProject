<?php

namespace App\Http\Traits;

use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

trait EvaluationTraits
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

    public static function StudentAssignmentEvaluation(Classroom $classroom)
    {
        if($classroom->assignments->count()!=0)
        {
            $totalPointsObtained = 0;
            $totalAssignmentPoints = 0;

            foreach($classroom->assignments as $assignment)
            {
                foreach ($assignment->student_points as $student_point)
                {
                    $count = 0;
                    if ($student_point->student->id == auth()->user()->student->id && $student_point->pointsObtained != null)
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

            $percent = round(($totalPointsObtained/$totalAssignmentPoints)*100,2);
        }

        else
        {
            $percent = 0;
        }

        return $percent;

    }
}
