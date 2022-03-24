<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewStudentAdmissionEvent;
use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\AdmissionWindow;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    public function createNewSession(Course $course)
    {
        return view('admin.admission.newSession', [
            'course' => $course,
        ]);
    }

    public function storeNewSession(Request $request)
    {
        $request->validate([
            'batch_name' => 'required|string|max:255',
            'batch_description' => 'required|string|max:255',
            'year' => 'required|string|max:255'
        ]);

        $batch = Batch::create($request->all());

        AdmissionWindow::create([
            'batch_id' => $batch->id,
            'course_id' => $batch->course_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect('/admin/batch/'. $batch->id);
    }

    public function endSession($id)
    {
        $admissionWindow = AdmissionWindow::where('batch_id', $id)
            ->update([
            'is_open' => 0
        ]);

        return redirect()->back();
    }

    public function admissionForm(AdmissionWindow $admissionWindow)
    {

        return view('admin.admission.admissionForm',[
            'admissionWindow' => $admissionWindow
        ]);
    }

    public function admissionData(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'temporaryAddress' => 'required|string|max:255',
            'permanentAddress' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
        ]);

        if($request->hasFile('photo'))
        {
            $image=$request->file('photo');
            $filename = 'avatar-' . time() . '.' . $image->getClientOriginalExtension();
            $Path = public_path('images/profile');
            $image->move($Path, $filename);

            $request->request->add(['pp_photo' => $filename]);
        }
        DB::transaction(function () use ($request) {
            // Create new Admission
            $student = Admission::create($request->all());;

            // Select admin to notify
            $user = User::find(1);

            // Call New Student Admission Event
            event(new NewStudentAdmissionEvent($student,$user));
        });
        
        return redirect('/admission/response');

    }

    public function Response()
    {
        return view('admin.admission.response');
    }

    public function admissionDetails(Admission $admission)
    {
        return view('admin.admission.studentDetails', [
            'admission' =>$admission
        ]);
    }
}
