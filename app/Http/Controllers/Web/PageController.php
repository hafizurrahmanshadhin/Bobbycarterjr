<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function termsAndConditions()
    {
        $dynamicPage = DynamicPage::query()
            ->where('status', 'active')
            ->where('id', 1)
            ->firstOrFail();
        return view('frontend.page', compact('dynamicPage'));
    }

    public function privacyAndPolicy()
    {
        $dynamicPage = DynamicPage::query()
            ->where('status', 'active')
            ->where('id', 2)
            ->firstOrFail();
        return view('frontend.page', compact('dynamicPage'));
    }
}
