<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Http\Traits\EvaluationTraits;
use App\Models\Batch;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ClassroomController extends Controller
{
    use EvaluationTraits;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Batch $batch)
    {
        return view('coordinator.classroom.index',[
            'classrooms' => Classroom::where([
                'batch_id' => $batch->id,
            ])->paginate(10),
            'batch' => Batch::find($batch->id),
            'semesters' => Semester::all()
        ]);
    }

    /**
     *
     * Classroom Dashboard
     *
     */
    public function classroom(Classroom $classroom)
    {
        $classroom->percent = EvaluationTraits::StudentAssignmentEvaluation($classroom);
        $classroom->courseCompleted = EvaluationTraits::CourseCompleted($classroom);

        $assignments = $classroom->assignments->where('due_date', '>', Carbon::now());
        foreach($assignments as $assignment)
        {
            $assignment->daysLeft = Carbon::now()->diffInDays($assignment->due_date);
        }

        $announcements = $classroom->announcements->sortByDesc('created_at');

        return view('coordinator.classroom.room',[
            'classroom' => $classroom,
            'assignments' => $assignments,
            'announcements' => $announcements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $batch_id = $request->input('batch_id');
        $course_id = $request->input('course_id');
        $semester_id = $request->input('semester_id');
        $eligibleStudents = Student::where('batch_id', $batch_id)
            ->orderBy('symbol_number')
            ->get();

        $subjects = Subject::where([
            'course_id'=> $course_id,
            'semester_id' => $semester_id
            ])->get();

        return view('coordinator.classroom.create', [
            'course' => Course::find($course_id),
            'batch' => Batch::find($batch_id),
            'semester' => Semester::find($semester_id),
            'subjects' => $subjects,
            'eligibleStudents' => $eligibleStudents
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = new Classroom();

        DB::transaction(function () use ($request, &$classroom) {


            if($request->hasFile('image'))
            {
                $image=$request->file('image');
                $filename = 'background-' . time() . '.' . $image->getClientOriginalExtension();
                $Path = public_path('/images/background');
                $image->move($Path, $filename);
                $classroom->image = $filename;
            }

            $classroom->room_name = $request->input('room_name');
            $classroom->description = $request->input('description');
            $classroom->batch_id = $request->input('batch_id');
            $classroom->subject_id = $request->input('subject_id');
            $classroom->created_by = $request->input('created_by');

            $classroom->save();

            $classroom->students()->sync($request->students);
        });

        return redirect('/coordinator/classroom/'. $classroom->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        $courseCompleted = EvaluationTraits::CourseCompleted($classroom);

        $eligibleStudents = Student::where('batch_id', $classroom->batch_id)
            ->orderBy('symbol_number')
            ->get();

        foreach($eligibleStudents as $student)
        {
            $student->isAdded = False;
            foreach($classroom->students as $value)
            {
                if($value->id == $student->id)
                {
                    $student->isAdded = True;
                    break;
                }
            }
        }

        $eligibleTeachers = Teacher::all();

        foreach($eligibleTeachers as $teacher)
        {
            $teacher->isAdded = False;

            foreach($classroom->teachers as $value)
            {
                if($value->id == $teacher->id)
                {
                    $teacher->isAdded = True;
                    break;
                }
            }
        }



        return view('coordinator.classroom.show', [
            'classroom' => $classroom,
            'eligibleStudents' => $eligibleStudents,
            'eligibleTeachers' => $eligibleTeachers,
            'courseCompleted' => $courseCompleted,
        ]);
    }

    /**
     *
     * Add Students to Classroom
     *
     */
    public function addStudents(Request $request)
    {

        DB::table('classroom_student')->insert([
            'classroom_id'=> $request->input('classroom_id'),
            'student_id' => $request->input('student_id')
        ]);

        $student = Student::find($request->input('student_id'))->user;

        return response()->json($student);
    }

    /**
     *
     * Remove Teacher from classroom
     *
     */
    public function removeStudent($id)
    {
        DB::table('classroom_student')->where('student_id', $id)->delete();

        return redirect()->back();
    }

    /**
     *
     * Add Teachers to Classroom
     *
     */
    public function addTeachers(Request $request)
    {
        DB::table('classroom_teacher')->insert([
            'classroom_id'=> $request->input('classroom_id'),
            'teacher_id' => $request->input('teacher_id')
        ]);

        $teacher = Teacher::find($request->input('teacher_id'))->user;

        return response()->json($teacher);
    }

    /**
     *
     * Remove Teacher from classroom
     *
     */
    public function removeTeacher($id)
    {
        DB::table('classroom_teacher')->where('teacher_id', $id)->delete();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('coordinator.classroom.edit',[
            'classroom' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = 'background-' . time() . '.' . $image->getClientOriginalExtension();
            $Path = public_path('/images/background');
            $image->move($Path, $filename);
            $classroom->image= $filename;
        }

        $classroom->room_name = $request->input('room_name');
        $classroom->description = $request->input('description');
        $classroom->batch_id = $request->input('batch_id');
        $classroom->subject_id = $request->input('subject_id');
        $classroom->created_by = $request->input('created_by');

        $classroom->save();

        return redirect('/coordinator/rooms/'. $classroom->batch_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        if($classroom->image != 'background.jfif')
        {
            $image_path = public_path('/images/background/'.$classroom->image);

            if (file_exists($image_path))
            {
                File::delete($image_path);
            }
        }

        $classroom->delete();
        return redirect('/coordinator/rooms/'. $classroom->batch_id);
    }
}
