<?php

namespace App\Http\Controllers\api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Controller
{

    /**
     * Toggle Bookmark add/remove.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function toggleBookmark(Request $request) {

        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        $articleID = $request->input('article_id');

        $validator = Validator::make($request->all(), [
            'article_id' => 'required|integer|exists:articles,id',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation Failed', 422, $validator->errors()->first());
        }

        // Check if the product is already in favorites
        $bookmark = Bookmark::where('user_id', $user->id)->where('article_id', $articleID)->first();

        if ($bookmark) {
            // If exists, remove from favorites
            $bookmark->delete();
            return Helper::jsonResponse(true, 'Ad removed from bookmark.', 200, $bookmark);
        } else {
            // If not, add to favorites
            $data = Bookmark::create([
                'user_id' => $user->id,
                'article_id' => $articleID,
            ]);
            return Helper::jsonResponse(true, 'Ad added to bookmark.', 200, $data);
        }
    }

    /**
     * Get Bookmarks Article.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */

    public function getBookmarks() {
        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return Helper::jsonResponse(false, 'User Not Authenticated', 401, []);
        }

        // Fetch bookmarked articles using the relationship
        $bookmarkedArticles = $user->bookmarkedArticles;

        // Check if any bookmarks were found
        if ($bookmarkedArticles->isEmpty()) {
            return Helper::jsonResponse(false, 'No Bookmark Articles found', 404, []);
        }

        // Optionally format the response to include only necessary fields
        $formattedBookmarks = $bookmarkedArticles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'image_url' => $article->image_url,
                'description' => $article->description,
            ];
        });

        return Helper::jsonResponse(true, 'Bookmark Articles retrieved successfully.', 200, $formattedBookmarks);
    }

}
