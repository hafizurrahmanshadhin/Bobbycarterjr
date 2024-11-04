<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array {
        return [
            'id'          => $this->id,
            'sender_id'   => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'text'        => $this->text,
            'sender'      => [
                'id'     => $this->sender->id,
                'name'   => $this->sender->fullName,
                'avatar' => $this->sender->avatar,
            ],
            'attachment'  => $this->attachment_path ? [
                'url'  => url($this->attachment_path),
                'name' => $this->attachment_name,
                'type' => $this->attachment_type,
            ] : null,
            'created_at'  => $this->created_at,
        ];
    }
}
