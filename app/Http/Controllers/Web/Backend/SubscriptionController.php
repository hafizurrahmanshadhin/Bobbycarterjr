<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index() {
        $data = Subscription::get();
        return view('backend.layouts.subscription.index', compact('data'));
    }

    public function edit($id) {
        $data = Subscription::with('details')->where('id', $id)->first();
        return view('backend.layouts.subscription.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:free,premium',
            'price' => 'nullable|numeric',
            'expire_date' => 'required|date',
            'title.*' => 'required|string',
            'description.*' => 'required|string',
        ], [
            'title.*.required' => 'Each title is required.',
            'title.*.string' => 'Each title must be a string.',
            'description.*.required' => 'Each description is required.',
            'description.*.string' => 'Each description must be a string.',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        // Database transaction
        DB::beginTransaction();

        try {
            // Update subscription
            $subscription = Subscription::where('id', $id)->first();
            $subscription->type = $request->type;
            $subscription->price = $request->price;
            $subscription->expire_at = $request->expire_date;
            $subscription->save();

            $subscription->details()->delete();

            foreach ($request->title as $index => $title) {
                SubscriptionDetail::create([
                    'subscription_id' => $subscription->id,
                    'title' => $title,
                    'description' => $request->description[$index],
                ]);
            }

            // Commit transaction
            DB::commit();

            return response()->json(['status' => 1, 'msg' => 'Subscription Successfully Updated!']);
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();

            return response()->json(['status' => 1, 'msg' => $e->getMessage()]);
        }
    }
}
