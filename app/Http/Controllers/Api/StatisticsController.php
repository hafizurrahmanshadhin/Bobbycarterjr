<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use App\Models\Module;
use App\Models\UserArticleComplete;
use App\Models\UserModulesComplete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    /**
     * Store Completed module.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completeModule(int $module_id) {

        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        $isAttached = $user->completedModules()->where('module_id', $module_id)->exists();

        $module = Module::findOrFail($module_id);

        if (!$isAttached) {
            // Attach the article to the user as read
            $user->completedModules()->attach($module_id, ['mark' => $module->mark, 'created_at' => Carbon::now()]);
        }

        return Helper::jsonResponse(true, 'Course Module Complete successfully', 200, $isAttached);
    }

    /**
     * Return Count Modul Status.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function moduleStatus(int $course_id) {

        $total_module = Module::where('course_id', $course_id)->count();

        $completed_module = UserModulesComplete::query()
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('module_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('modules')
                                ->where('course_id', $course_id);
                        })
                        ->count();
        $course = Course::where('id', $course_id)->first();

        $response = [
            'total_module' => $total_module,
            'total_completed_module' => $completed_module,
            'course_image' => $course->image_url,
        ];


        return Helper::jsonResponse(true, 'Course Module Status retrieved successfully', 200, $response);
    }

    /**
     * Return Count specific Modul Status.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function specificModuleStatus(int $course_id) {

        $specific_total_module = Module::query()
                        ->where('course_id', $course_id)
                        ->where('is_exam', 0)
                        ->count();

        $specific_completed_module = UserModulesComplete::query()
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('module_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('modules')
                                ->where('course_id', $course_id)
                                ->where('is_exam', 0);
                        })
                        ->count();

        $response = [
            'specific_total_module' => $specific_total_module,
            'specific_total_completed_module' => $specific_completed_module,
        ];


        return Helper::jsonResponse(true, 'Course Module Status retrieved successfully', 200, $response);
    }

    /**
     * Return Count specific Task Status.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function specificTaskStatus(int $course_id) {

        $specific_total_task = Module::query()
                        ->where('course_id', $course_id)
                        ->where('is_exam',1)
                        ->count();

        $specific_completed_task = UserModulesComplete::query()
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('module_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('modules')
                                ->where('course_id', $course_id)
                                ->where('is_exam', 1);
                        })
                        ->count();

        $response = [
            'specific_total_task' => $specific_total_task,
            'specific_total_completed_task' => $specific_completed_task,
        ];


        return Helper::jsonResponse(true, 'Course Task Status retrieved successfully', 200, $response);
    }

    /**
     * Store Completed Article.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completeArticle(int $article_id) {

        $user = Auth::user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        $isAttached = $user->articleCompletes()->where('article_id', $article_id)->exists();

        $article = Article::findOrFail($article_id);

        if (!$isAttached) {
            $user->articleCompletes()->create([
                'article_id' => $article_id,
                'mark' => $article->mark, // Assuming you want to store the article's mark
            ]);
        }

        return Helper::jsonResponse(true, 'Article Complete successfully', 200, $isAttached);
    }

    /**
     * Return Count Article Status.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function articleStatus(int $course_id) {

        $total_article = Article::where('course_id', $course_id)->count();

        $completed_article = UserArticleComplete::query()
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('article_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('articles')
                                ->where('course_id', $course_id);
                        })
                        ->count();

        $response = [
            'total_article' => $total_article,
            'total_completed_article' => $completed_article
        ];


        return Helper::jsonResponse(true, 'Course Article Status retrieved successfully', 200, $response);
    }

    /**
     * Return Total Completed Task.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completedTask(int $course_id) {
        $completed_task = UserModulesComplete::query()
                        ->with('module:id,title')
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('module_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('modules')
                                ->where('course_id', $course_id)
                                ->where('is_exam', 1);
                        })
                        ->get();
        return Helper::jsonResponse(true, 'Completed Task retrieved successfully', 200, $completed_task);
    }

    /**
     * Return Total Completed Module.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completedModule(int $course_id) {
        $completed_modul = UserModulesComplete::query()
                        ->with('module:id,title')
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('module_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('modules')
                                ->where('course_id', $course_id)
                                ->where('is_exam', 0);
                        })
                        ->get();
        return Helper::jsonResponse(true, 'Completed Module retrieved successfully', 200, $completed_modul);
    }

    /**
     * Return Total Completed Article.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function completedArticle(int $course_id) {
        $completed_article = UserArticleComplete::query()
                        ->with('article:id,title')
                        ->where('user_id', Auth::user()->id)
                        ->whereIn('article_id', function ($query) use ($course_id) {
                            $query->select('id')
                                ->from('articles')
                                ->where('course_id', $course_id);
                        })
                        ->get();
        return Helper::jsonResponse(true, 'Completed Article retrieved successfully', 200, $completed_article);
    }

    /**
     * Return All Completed Tasks, Modules, and Articles.
     *
     * @param  int  $course_id
     * @return JsonResponse
     */
    public function allCompleted(int $course_id) {
        $userId = Auth::user()->id;

        // Get completed tasks sorted by created_at
        $completed_tasks = UserModulesComplete::query()
            ->with('module:id,title')
            ->where('user_id', $userId)
            ->whereIn('module_id', function ($query) use ($course_id) {
                $query->select('id')
                    ->from('modules')
                    ->where('course_id', $course_id)
                    ->where('is_exam', 1);
            })
            ->orderBy('created_at', 'desc') // Sort by created_at
            ->get();

        // Get completed modules sorted by created_at
        $completed_modules = UserModulesComplete::query()
            ->with('module:id,title')
            ->where('user_id', $userId)
            ->whereIn('module_id', function ($query) use ($course_id) {
                $query->select('id')
                    ->from('modules')
                    ->where('course_id', $course_id)
                    ->where('is_exam', 0);
            })
            ->orderBy('created_at', 'desc') // Sort by created_at
            ->get();

        // Get completed articles sorted by created_at
        $completed_articles = UserArticleComplete::query()
            ->with('article:id,title')
            ->where('user_id', $userId)
            ->whereIn('article_id', function ($query) use ($course_id) {
                $query->select('id')
                    ->from('articles')
                    ->where('course_id', $course_id);
            })
            ->orderBy('created_at', 'desc') // Sort by created_at
            ->get();

        $all = $completed_tasks->merge($completed_modules)->merge($completed_articles);
        $all->sortBy('created_at');

        return Helper::jsonResponse(true, 'All Completed Items retrieved successfully', 200, $all);
    }

}
