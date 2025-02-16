<?php

namespace App\Events;

use App\Models\Discussions;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DiscussionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discussion;



    /**
     * Create a new event instance.
     */
    public function __construct(Discussions $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('forum-diskusi'),
        ];
    }
    public function broadcastAs(): string
    {
        return 'discussion-updated';
    }
    public function broadcastWith(): array
    {
        return [
            'id' => $this->discussion->id,
            'courses_id' => $this->discussion->courses->name,
            'user_id' => $this->discussion->user->name,
            'content' => $this->discussion->content,
        ];
    }
}
