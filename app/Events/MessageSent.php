<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message) {
        //* Load necessary relationships
        $message->load('sender:id,firstName,lastName,avatar');
        $this->message = new MessageResource($message);
    }

    /**
     * Determine the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array {
        return [
            new PrivateChannel("chat.{$this->message->receiver_id}"),
            new PrivateChannel("chat.{$this->message->sender_id}"),
        ];
    }
}
