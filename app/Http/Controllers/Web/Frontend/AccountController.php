<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {
    public function deletePage() {
        return view('frontend.delete');
    }

    public function userDelete(Request $request) {
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not authenticated.');
            }

            // Delete avatar if exists
            if ($user->avatar) {
                $path = public_path($user->avatar);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $user->delete();

            return redirect('/')->with('success', 'Your account has been deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting account: ' . $e->getMessage());
        }
    }
}
