<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendMail()
    {
        $details = [
            'title' => 'Test Mail',
            'body' => 'Testing mail using gmail'
        ];

        Mail::to('aarohan@acd.edu.np')->send(new SendAdminMail($details));

        return "Email Sent";
    }
}
