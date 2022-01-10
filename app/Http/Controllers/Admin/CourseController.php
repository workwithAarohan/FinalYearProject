<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $courses = Course::all();

        return view("admin.course.index",[
            'courses' => Course::paginate(10)
        ]);
    }

    /**
     * Display a list of course related batch
     *
     */
    public function batch_index(Course $course)
    {
        return view('admin.course.batches', [
            'course' => $course,
            'batches' => $course->batches()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
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
            'slug' => 'required',
            'course_name' => 'required|max:255',
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'objective' => 'required'
        ]);

        DB::transaction(function () use ($request ) {

            // Create new Course
            $course = Course::create($request->all());

            // Add Course Details
            DB::table('course_details')->insert([
                'course_id' => $course->id,
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'image' => $request->input('image'),
                'description' => $request->input('description'),
                'objective' => $request->input('objective'),
            ]);
        });


        return redirect('/admin/course');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $semesters = Semester::all();

        foreach($semesters as $semester)
        {
            $subject = Subject::where('course_id', $course->id)
                ->where('semester_id', $semester->id)->get();
            $semester->subject = $subject;

            $semester->electiveCount = Subject::where('course_id', $course->id)
                ->where('semester_id', $semester->id)
                ->where('is_elective', 1)
                ->count();
        }

        return view('admin.course.show',[
            'course' => $course,
            'semesters' => $semesters,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        // $course = Course::find($id);   //Select * from courses where id = $id;

        return view('/admin/course/edit',[
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'slug' => 'required',
            'course_name' => 'required|max:255',
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'objective' => 'required'
        ]);

        $course->update($request->all());

        $course->courseDetails->update($request->except('_token'));

        return redirect('/admin/course');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/admin/course');
    }
}
