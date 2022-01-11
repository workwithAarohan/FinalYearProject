<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\AdmissionWindow;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Role;
use Illuminate\Http\Request;

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

        Admission::create($request->all());

        return redirect('/');

    }
}
