<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array {
        // return [
        //     'id'         => $this->id,
        //     'message'    => $this->data['message'],
        //     'created_at' => $this->created_at->diffForHumans(),
        //     'read_at'    => $this->read_at,
        // ];

        return [
            'id'              => $this->id,
            'type'            => $this->type,
            'notifiable_type' => $this->notifiable_type,
            'notifiable_id'   => $this->notifiable_id,
            'message'         => $this->data['message'],
            'user_avatar'     => $this->data['user_avatar'] ?? null,
            'property_images' => $this->data['property_images'] ?? null,
            'created_at'      => $this->created_at->format('l g:i A'),
            'read_at'         => $this->read_at,
        ];
    }
}
