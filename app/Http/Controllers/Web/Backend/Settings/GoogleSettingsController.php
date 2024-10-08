<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class GoogleSettingsController extends Controller {
    /**
     * Display google settings page.
     *
     * @return View
     */
    public function index(): View {
        return view('backend.layouts.settings.google_settings');
    }

    /**
     * Update google settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $request->validate([
            'GOOGLE_CLIENT_ID'     => 'nullable|string',
            'GOOGLE_CLIENT_SECRET' => 'nullable|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/GOOGLE_CLIENT_ID=(.*)\s/',
                '/GOOGLE_CLIENT_SECRET=(.*)\s/',
            ], [
                'GOOGLE_CLIENT_ID=' . $request->GOOGLE_CLIENT_ID . $lineBreak,
                'GOOGLE_CLIENT_SECRET=' . $request->GOOGLE_CLIENT_SECRET . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            return redirect()->back()->with('t-success', 'Google Setting Update successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Google Setting Update Failed');
        }
    }
}
