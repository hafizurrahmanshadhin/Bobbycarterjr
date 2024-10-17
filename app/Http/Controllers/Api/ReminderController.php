<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use App\Models\Reminder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{

    /**
     * Store Reminder Data.
     *
     * This method handles the validation and storage of a new reminder entry.
     * It first validates the incoming request data, then attempts to create a
     * new reminder for the authenticated user. If the creation is successful,
     * the reminder data is returned in a structured JSON response.
     * In case of validation failure or other errors, appropriate error messages
     * are returned.
     *
     * @param  Request  $request
     * @return JsonResponse
     */


    public function reminderStore(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'headline' => 'required|string|max:255',
            'description' => 'required|string',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {

            // Create the reminder entry
            $reminder = Reminder::create([
                'user_id' => Auth::user()->id,
                'headline' => $request->headline,
                'description' => $request->description,
                'reminder_date' => $request->reminder_date,
                'reminder_time' => $request->reminder_time,
            ]);

            // Format the reminder time using Carbon
            $formattedTime = Carbon::parse($reminder->reminder_time)->format('h:i A');

            $reminderData = [
                'id' => $reminder->id,
                'user_id' => $reminder->user_id,
                'headline' => $reminder->headline,
                'description' => $reminder->description,
                'reminder_date' => $reminder->reminder_date,
                'reminder_time' => $formattedTime,
            ];


            return Helper::jsonResponse(true, 'Reminder Created Successfully.', 200, $reminderData);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the reminder.', 500, $e->getMessage());
        }
    }


    /**
     * Fetching Single Reminder Data.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function SingleReminder(int $id)
    {

        $data = Reminder::findOrFail($id);

        // Check if the article was found
        if ($data === null) {
            return Helper::jsonResponse(false, 'Course Reminder not found', 404, []);
        }

        return Helper::jsonResponse(true, 'Course Reminder retrieved successfully', 200, $data);
    }

    /**
     * Retrieve All Reminders for Authenticated User.
     *
     * This method fetches all reminders associated with the currently authenticated user.
     * It checks the reminders based on the user's ID and returns them in a structured
     * JSON response. If no reminders are found for the user, an empty array is returned
     * with a "Reminder not found" message. Otherwise, the list of reminders is returned
     * with a success message.
     *
     * @return JsonResponse
     */

    public function getAllReminders()
    {

        $reminder = Reminder::where('user_id', auth()->id())->get();

        // Check if the Course Types was found
        if ($reminder->isEmpty()) {
            return Helper::jsonResponse(true, 'Reminder not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Reminder retrieved successfully', 200, $reminder);
    }

    /**
     * Deleting a specific Reminder.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function reminderDelete(int $id)
    {

        // dd($id);
        $data = Reminder::findOrFail($id);

        $data->delete();

        return Helper::jsonResponse(true, 'Reminder Deleted', 200, []);
    }

    /**
     * Updating a specific Reminder.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */

    public function reminderUpdate(Request $request, int $id)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'headline' => 'required|string|max:255',
            'description' => 'required|string',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {

            $reminder = Reminder::findOrFail($id);


            // Create the reminder entry
            $data = $reminder->update([
                'headline' => $request->headline,
                'description' => $request->description,
                'reminder_date' => $request->reminder_date,
                'reminder_time' => $request->reminder_time,
            ]);

            return Helper::jsonResponse(true, 'reminder Updated', 200, $data);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the reminder.', 500, $e->getMessage());
        }
    }
}
