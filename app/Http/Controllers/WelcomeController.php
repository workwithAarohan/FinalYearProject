<?php

namespace App\Http\Controllers;

use App\Models\AdmissionWindow;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function admissionOpen()
    {
        $admissionWindows = AdmissionWindow::where('is_open',1)->get();
        $admissionWindows->count = AdmissionWindow::where('is_open', 1)->count();

        return view('admission',[
            'admissionWindows' => $admissionWindows
        ]);
    }
}
