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
        $batch = Batch::create($request->all());

        AdmissionWindow::create([
            'batch_id' => $batch->id,
            'course_id' => $batch->course_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect('/admin/batch/'. $batch->id);
    }
}
