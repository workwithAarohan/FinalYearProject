<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewStudentAdmissionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student, $user, $enrollmentData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($student, $user)
    {
        $this->student = $student;
        $this->user = $user;

        $this->enrollmentData = [
            'body' => 'You received a new Notification',
            'enrollmentText' => 'New Student has enrolled for the course',
            'url' => url('/'),
            'thankyou' => 'Please approve the student'
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
