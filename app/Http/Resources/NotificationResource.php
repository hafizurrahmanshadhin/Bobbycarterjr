<?php
namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request) {
        $data          = json_decode($this->data, true);
        $formattedData = isset($data['description']) ? $data['description'] : (isset($data['message']) ? $data['message'] : null);

        $userName   = null;
        $userAvatar = null;

        if ($this->notifiable && $this->notifiable instanceof User) {
            $userName   = $this->notifiable->firstName . ' ' . $this->notifiable->lastName;
            $userAvatar = $this->notifiable->avatar;
        }

        return [
            'id'          => $this->id,
            'user_name'   => $userName,
            'user_avatar' => $userAvatar,
            'created_at'  => $this->created_at,
            'read_at'     => $this->read_at,
            'data'        => $formattedData,
        ];
    }
}
