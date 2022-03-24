<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Examination;
use App\Models\Result;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $examination = DB::table('examination')
        //                     ->select(DB::raw('DATE(created_at) as date'))
        //                     ->groupBy('DATE(created_at)')
        //                     ->get();

        return view('coordinator.examination.index',[
            'examination' => Examination::orderBy('created_at', 'desc')->get(),
            'courses' => Course::all(),
            'semesters' => Semester::all(),

        ]);
    }

    public function selectBatch($course)
    {
        $batches = Batch::where('course_id', $course)->get();

        return response()->json($batches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'exam_title' => 'required',
            'instruction' => 'required',
            'exam_year' => 'required',
            'course_id' => 'required',
            'batch_id' => 'required',
            'semester_id' => 'required',
            'created_by' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        DB::transaction(function () use ($request) {

            $examination = Examination::create($request->all());

            $subjects = Subject::where('course_id', $examination->course_id)->where('semester_id', $examination->semester_id)->get();

            foreach($subjects as $subject)
            {
                if($subject->batch_classrooms($examination->batch_id)->where('is_active',1)->exists())
                {
                    DB::table('examination_subject')->insert([
                        'examination_id' => $examination->id,
                        'subject_id' => $subject->id,
                        'teacher_id' => 1,
                    ]);
                }
            }

            $exams = DB::table('examination_subject')->where('examination_id', $examination->id)->get();

            foreach($examination->batch->students as $student)
            {
                foreach($exams as $exam)
                {
                    Result::create([
                        'examination_id' => $exam->examination_id,
                        'subject_id' => $exam->subject_id,
                        'student_id' => $student->id,
                        'teacher_id' => $exam->teacher_id,
                    ]);
                }
            }
        });

        return redirect('/coordinator/examination');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        // $details = DB::select(DB::raw(
        //     'SELECT subject_id  from results where examination_id='. $examination->id . ' group by subject_id'
        // ));

        // foreach($details as $detail)
        // {
        //     $subjects[$detail->subject_id] = Subject::find($detail->subject_id);
        // }

        // if($examination->is_published)
        // {
            $pass = null;
            $fail = null;
            foreach($examination->batch->students as $student)
            {
                $total = null;
                $full_marks = null;
                $status = null;
                foreach($examination->subjects as $subject)
                {
                    if($subject->pivot->is_checked)
                    {
                        $result[$student->id][$subject->id] = Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('examination_id', $examination->id)->first();

                        if($result[$student->id][$subject->id]->marks_obtained != null)
                            $total += $result[$student->id][$subject->id]->marks_obtained;

                        $full_marks += $subject->pivot->full_mark;

                        if(($result[$student->id][$subject->id]->marks_obtained < $subject->pivot->pass_mark))
                        {
                            $status = 0;
                        }
                        else
                        {
                            $status = true;
                        }
                    }

                }

                $result[$student->id]['total'] = $total;
                if($full_marks != null)
                {
                    $result[$student->id]['percentage'] = round(($total / $full_marks) * 100, 2);
                }
                else
                {
                    $result[$student->id]['percentage'] = null;
                }
                $result[$student->id]['status'] = $status;
                
                if($status)
                {
                    $pass++;

                }
                else
                {
                    $fail++;
                }
            }
            $resultReport = "['Pass', ".$pass."], ['Fail', ".$fail."]";
        // }

        // else
        // {
        //     $result = [];
        //     $resultReport = "";
        // }


        return view('coordinator.examination.show', [
            'examination' => $examination,
            'result' => $result,
            'resultReport' => $resultReport,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function edit(Examination $examination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examination $examination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examination $examination)
    {
        //
    }

    public function updateTable(Request $request)
    {
        $request->validate([
            'full_mark' => 'required',
            'pass_mark' => 'required',
        ]);

        DB::table('examination_subject')->where('subject_id', $request->subject)->update([
            'full_mark' =>$request->full_mark,
            'pass_mark' => $request->pass_mark,
        ]);

        Examination::find($request->exam)->update([
            'is_locked' => 0
        ]);

        $request->session()->flash('success','Updated');

        return redirect()->back();
    }

    public function examinationPublish(Request $request)
    {
        $examination = Examination::find($request->examination_id);

        if($examination->is_published)
        {
            $published = 0;
        }

        else
        {
            $published = 1;
        }
        $examination->update([
            'is_published' => $published
        ]);

        return redirect()->back();
    }
}
