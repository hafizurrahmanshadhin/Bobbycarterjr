<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Journal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller {
    /**
     * Store Jurnal Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function journalStore(Request $request) {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {
            $imagePath = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Journal', $imageName);
            }

            // Create the journal entry
            $data = Journal::create([
                'user_id'     => auth()->id(), // Assuming you want to associate the journal with the authenticated user
                'title' => $request->title,
                'description' => $request->description,
                'image_url'   => $imagePath,
            ]);

            return Helper::jsonResponse(true, 'Journal Created Successful.', 200, $data);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the journal.', 500, $e->getMessage());
        }
    }

    /**
     * Fetching Single JOurnal Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function SingleJournal(int $id) {

        $data = Journal::findOrFail($id);

        // Check if the article was found
        if ($data === null) {
            return Helper::jsonResponse(false, 'Course Journal not found', 404, []);
        }

        return Helper::jsonResponse(true, 'Course Journal retrieved successfully', 200, $data);
    }

    /**
     * Fetching All JOurnal Data .
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function getAllJournals() {

        $data = Journal::where('user_id', auth()->id())->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Journal not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Journal retrieved successfully', 200, $data);
    }

    /**
     * Deleting JOurnal Based On ID .
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function journalDelete(int $id) {

        $data = Journal::findOrFail($id);

        if ($data->image_url) {
            $previousImagePath = public_path($data->image_url);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $data->delete();

        return Helper::jsonResponse(true, 'Journal Deleted', 200, []);
    }

    /**
     * Edit JOurnal Based On ID .
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function journalUpdate(Request $request, int $id) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        try {

            $journal   = Journal::findOrFail($id);
            $imagePath = null;

            // Handle image upload
            if ($request->hasFile('image')) {

                if ($journal->image_url) {
                    $previousImagePath = public_path($journal->image_url);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }

                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'Journal', $imageName);
            }else {
                $imagePath = $journal->image_url;
            }

            // Create the journal entry
            $data = $journal->update([
                'title'       => $request->title,
                'description' => $request->description,
                'image_url'   => $imagePath,
            ]);

            return Helper::jsonResponse(true, 'Journal Updated', 200, $data);
        } catch (\Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the journal.', 500, $e->getMessage());
        }
    }
}
