<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatusUpdated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Determine the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel {
        return new Channel("user.status.{$this->user->id}");
    }

    /**
     * Define a custom broadcast event name.
     *
     * @return string
     */
    public function broadcastAs(): string {
        return 'user.status.updated';
    }

    /**
     * Data to be broadcasted.
     *
     * @return array
     */
    public function broadcastWith(): array {
        return [
            'id'        => $this->user->id,
            'is_online' => $this->user->is_online,
        ];
    }
}
