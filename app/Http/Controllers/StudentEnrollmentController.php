<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StudentEnrollment;

class StudentEnrollmentController extends Controller
{
    public function sendEnrollmentNotification()
    {
        $user = User::first();

        $enrollmentData = [
            // 'body' => 'Enrollment Notification',
            // 'enrollmentText' => 'New Student has enrolled',
            // 'url' => url('/'),
            // 'thankyou' => 'Test the message'

            'title' => 'New Admission Request',
            'message' => 'New Student has requested for admission'
        ];

        $user->notify(new StudentEnrollment($enrollmentData,$user));

        return redirect('home');

        // Notification::send($user, new StudentEnrollment($enrollmentData));
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()
            ->unreadNotifications
            ->where('id', $notificationId)
            ->first();

        if($notification)
        {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function deleteNotification($notificationId)
    {
        $notification = auth()->user()
            ->notifications
            ->where('id', $notificationId)
            ->first();

        if($notification)
        {
            $notification->delete();
        }

        return redirect()->back();
    }

    public function StudentInfo($studentId)
    {
        return view('notification.enrolledInfo',[
            'student' => User::find($studentId)
        ]);
    }
}
