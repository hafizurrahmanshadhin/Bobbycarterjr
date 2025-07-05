<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class VoiceController extends Controller {
    public function rrr($text) {

        return view('frontend.voice', compact('text'));
    }
}
