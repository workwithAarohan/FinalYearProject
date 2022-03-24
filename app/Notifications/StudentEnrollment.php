<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentEnrollment extends Notification
{
    use Queueable;
    private $student, $enrollmentData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student, $enrollmentData)
    {
        $this->student = $student;
        $this->enrollmentData = $enrollmentData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->enrollmentData['body'])
                    ->action($this->enrollmentData['enrollmentText'],
                    $this->enrollmentData['url'])
                    ->line($this->enrollmentData['thankyou']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'New Admission Request',
            'message' => 'New Student has requested for admission',
            'logo' => '/images/logo/student.png',
            'route' => 'admission.details',
            'id' => $this->student['id']
        ];
    }
}
