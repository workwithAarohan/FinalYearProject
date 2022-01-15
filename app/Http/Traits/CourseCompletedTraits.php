<?php

namespace App\Http\Traits;

use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

trait CourseCompletedTraits
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
}
