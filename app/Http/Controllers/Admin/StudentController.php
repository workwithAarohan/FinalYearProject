<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewStudentAdmissionEvent;
use App\Http\Controllers\Controller;
use App\Http\Traits\ClassroomEvaluationTraits;
use App\Http\Traits\StudentPerformanceTraits;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\StudentEnrollment;

use App\Models\User;
use App\Models\Batch;
use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    use ClassroomEvaluationTraits, StudentPerformanceTraits;

    public function index()
    {

        return view('admin.students.index',[
            'students' => Student::paginate(10)
        ]);
    }

    public function create()
    {
        $roles = Role::where('name','=','Student')->select('id')->get();

        return view('admin.students.create',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $admission = Admission::find($request->admission_id);

        $admission->is_admitted = 1;
        $admission->save();

        // $admission->update([
        //     'is_admitted' => 0,
        // ]);

        $request->merge([
            'username' => strtolower($admission->firstname) . "@academia",
        ]);

        DB::transaction(function () use ($request, $admission) {
            // Create new Student
            $student = User::create([
                'firstname' => $admission->firstname,
                'lastname' => $admission->lastname,
                'username' => $request->username,
                'email' => $admission->email,
                'password' => 'password',
                'avatar' => $admission->pp_photo,
                'temporaryAddress' => $admission->temporaryAddress,
                'permanentAddress' => $admission->permanentAddress,
                'phone' => $admission->phone,
                'dob' => $admission->dob,
                'gender' => $admission->gender,
                'nationality' => $admission->nationality,
            ]);

            // Insert into user_role table
            $student->roles()->sync($request->roles);

            Student::create([
                'user_id' => $student->id,
                'course_id' => $admission->admission_window->course_id,
                'batch_id' => $admission->admission_window->batch_id,
                'semester_id' => 1,
                'admission_date' => date('Y-m-d'),
            ]);

            // Select admin to notify
            // $user = User::find(1);

            // Call New Student Admission Event
            // event(new NewStudentAdmissionEvent($student,$user));
        });


        return redirect()->back();
    }

    public function show($id)
    {
        return view('admin.students.index',[
            'students' => User::paginate(10)
        ]);
    }

    public function dashboard()
    {
        $student = User::findOrFail(auth()->user()->id)->student;

        $classrooms = $student->classrooms;

        foreach($classrooms as $classroom)
        {
            $classroom->courseCompleted = ClassroomEvaluationTraits::CourseCompleted($classroom);
        }

        $semester = $student->semester;

        $semester->attendance = StudentPerformanceTraits::OverallAttendance($semester, $student);
        $semester->assignment = StudentPerformanceTraits::OverallAssignment($semester, $student);

        return view('student.dashboard', [
            'student' => $student,
            'classrooms' => $classrooms,
            'semester' => $semester,
        ]);
    }

    public function studentPerformance(Classroom $classroom, Student $student)
    {
        $student->attendancePercent = ClassroomEvaluationTraits::StudentAttendanceEvaluation($classroom, $student);
        $student->assignmentPercent = ClassroomEvaluationTraits::StudentAssignmentEvaluation($classroom, $student);

        return view('coordinator.classroom.student.performance', [
            'student' => $student,
            'classroom' => $classroom,
            'semesters' => Semester::all()
        ]);
    }
}

