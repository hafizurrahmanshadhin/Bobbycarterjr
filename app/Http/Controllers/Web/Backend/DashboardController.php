<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Article;
use Illuminate\View\View;
use App\Models\CourseType;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index(): View {

        $total_course_type = CourseType::where('status', 'active')->count();
        $total_course = Course::where('status', 'active')->count();
        $total_course_module = Module::where('status', 'active')->count();
        $total_course_article = Article::where('status', 'active')->count();
        $total_user = User::where('status', 'active')->count();

        return view('backend.layouts.dashboard.index', compact('total_course_type', 'total_course', 'total_course_module', 'total_course_article','total_user'));
    }
}
