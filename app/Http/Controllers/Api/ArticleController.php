<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller {
    /**
     * Return Article Under a Course Data.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function courseArticle(int $course_id) {
        $user = auth()->user();

        // Retrieve all active articles for the specified course
        $data = Article::where('course_id', $course_id)
            ->where('status', 'active')
            ->get();

        // Check if any articles were found
        if ($data->isEmpty()) {
            return Helper::jsonResponse(true, 'Course Article not found', 200, []);
        }

        // Fetch the course
        $course = Course::findOrFail($course_id);

        // Map through the articles and set `is_bookmarked` based on user bookmarks
        $articlesWithFormattedTime = $data->map(function ($article) use ($user) {
            $isBookmarked = false;

            // Check if user is authenticated and if the article is bookmarked by the user
            if ($user) {
                $isBookmarked = Bookmark::where('user_id', $user->id)
                    ->where('article_id', $article->id)
                    ->exists();
            }

            return [
                'id'            => (int) $article->id,
                'course_id'     => (int) $article->course_id,
                'image_url'     => (string) $article->image_url,
                'title'         => (string) $article->title,
                'description'   => (string) $article->description,
                'mark'          => (int) $article->mark,
                'file_url'      => (string) $article->file_url,
                'audio_time'    => $this->formatAudioTimeToMinutes($article->audio_time),
                'is_bookmarked' => $isBookmarked,
            ];
        });

        // Prepare the response
        $response = [
            'course_image' => $course->image_url,
            'articles'     => $articlesWithFormattedTime,
        ];

        return Helper::jsonResponse(true, 'Course Article retrieved successfully', 200, $response);
    }

    private function formatAudioTimeToMinutes($seconds) {
        $minutes = floor($seconds / 60);
        return sprintf('%d', $minutes);
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

        // Check if the current user has bookmarked this article
        $data->is_bookmarked = $data->bookmarkedBy->contains($id);

        // Optionally, unset the bookmarkBy relation if you don't need it
        unset($data->bookmarkedBy);

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
        $user = Auth()->user();

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
                'id'          => $article->id,
                'course_id'   => $article->course_id,
                'image_url'   => $article->image_url,
                'title'       => $article->title,
                'description' => $article->description,
                'audio_time'  => $this->formatAudioTimeToMinutes($article->audio_time),
            ];
        });

        return Helper::jsonResponse(true, 'Daily Read Course Articles retrieved successfully', 200, $formattedData);
    }
}
