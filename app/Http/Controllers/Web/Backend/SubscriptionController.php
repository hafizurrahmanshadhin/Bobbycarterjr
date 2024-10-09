<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

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

        $request->validate([
            'type' => 'required',
            'price' => 'nullable',
            'expire_date' => 'required|date',
        ]);
    }
}
