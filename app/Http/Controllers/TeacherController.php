<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ClassroomEvaluationTraits;

class TeacherController extends Controller
{
    use ClassroomEvaluationTraits;

    public function dashboard()
    {
        $teacher = User::findOrFail(auth()->user()->id)->teacher;

        $classrooms = $teacher->classrooms;

        foreach($classrooms as $classroom)
        {
            $classroom->courseCompleted = ClassroomEvaluationTraits::CourseCompleted($classroom);
        }


        return view('teacher.dashboard', [
            'teacher' => $teacher,
            'classrooms' => $classrooms,
        ]);
    }
}
