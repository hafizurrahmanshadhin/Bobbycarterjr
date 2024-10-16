<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource
{
    /**
     * Transform the resource into an array for JSON response.
     *
     * This method defines how the Reminder resource will be represented
     * when converted to an array. It is primarily used for API responses
     * to provide a structured format for the reminder data.
     *
     * @param Request $request The incoming request instance.
     * @return array The array representation of the reminder resource,
     *               including its ID, user ID, headline, description,
     *               reminder date, and reminder time.
     */

    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'user_id'    => $this->user_id,
            'headline'    => $this->headline,
            'description'    => $this->description,
            'reminder_date'    => $this->reminder_date,
            'reminder_time'    => $this->reminder_time,
        ];
    }
}
