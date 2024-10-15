<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Return Article Under a Course Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function courseArticle(int $course_id) {

        $data = Article::where('course_id', $course_id)->where('status', 'active')->get();

        // Check if the Course Types was found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course Article not found', 200, []);
        }

        return Helper::jsonResponse(true, 'Course Article retrieved successfully', 200, $data);
    }

    /**
     * Return Single Article Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function courseSingleArticle(int $id) {

        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        // Retrieve the article
        $data = Article::findOrFail($id);

        // Check if the article was found
        if ($data === null) {
            return Helper::jsonResponse(false, 'Course Article not found', 404, []);
        }

        // Check if the article is already attached to the user

        $isAttached = $user->articles()->where('article_id', $id)->exists();

        if (!$isAttached) {
            // Attach the article to the user as read
            $user->articles()->attach($id, ['is_read' => 1]);
        }

        return Helper::jsonResponse(true, 'Course Article retrieved successfully', 200, $data);
    }


    /**
     * Return Daily Read Article Under a Course Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function courseDailyReadArticle(int $course_id) {
        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        // Get the user's articles filtered by course ID and read status
        $data = $user->articles()
                     ->where('articles.course_id', $course_id)
                     ->where('is_read', true)
                     ->get();

        // Check if any articles were found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(false, 'Daily Read Course Articles not found', 404, []);
        }

        // Format the response to remove the pivot relationship
        $formattedData = $data->map(function ($article) {
            return [
                'id' => $article->id,
                'course_id' => $article->course_id,
                'image_url' => $article->image_url,
                'title' => $article->title,
                'description' => $article->description,
            ];
        });

        return Helper::jsonResponse(true, 'Daily Read Course Articles retrieved successfully', 200, $formattedData);
    }
}
