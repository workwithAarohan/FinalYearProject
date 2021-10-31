<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostNoticeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notice, $sender, $receiver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notice)
    {
        $this->notice = $notice;
        $this->sender = auth()->user();
        $this->receiver = User::find(64);
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
