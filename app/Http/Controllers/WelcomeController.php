<?php

namespace App\Http\Controllers;

use App\Models\AdmissionWindow;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function admissionOpen()
    {
        $admissionWindows = AdmissionWindow::all();

        return view('admission',[
            'admissionWindows' => $admissionWindows
        ]);
    }
}
