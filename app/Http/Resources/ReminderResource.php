<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'headline'      => $this->headline,
            'description'   => $this->description,
            'reminder_date' => $this->reminder_date,
            'reminder_time' => Carbon::parse($this->reminder_time)->format('h:i A'),
        ];
    }
}
