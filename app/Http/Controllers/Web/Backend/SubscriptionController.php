<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'price' => 'nullable',
            'expire_date' => 'required|date',
            'title.*' => 'required|string',
            'description.*' => 'required|string',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else {

            Subscription::create([
                'type' => $request->type,
                'price' => $request->price,
                'expire_at' => $request->expire_date,
            ]);

            return response()->json(['status' => 1, 'msg' => 'Subscription Successfully Updated!']);
        }
    }
}
