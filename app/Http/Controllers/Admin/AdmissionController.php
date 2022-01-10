<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWindow;
use App\Models\Batch;
use App\Models\Course;
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
}
