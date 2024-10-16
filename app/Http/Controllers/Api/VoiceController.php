<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
    public function rrr($text) {

        return view('frontend.voice', compact('text'));
    }
}
