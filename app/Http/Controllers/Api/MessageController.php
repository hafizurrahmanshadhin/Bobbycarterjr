<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller {
    /**
     ** Get messages between the authenticated user and another user
     *
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function GetMessages(User $user, Request $request): JsonResponse {
        try {
            $authUser = $request->user();

            if (!$authUser) {
                return Helper::jsonResponse(false, 'User not authenticated', 401);
            }

            $authUserId = $authUser->id;

            $messages = Message::where(function ($query) use ($authUserId, $user) {
                $query->where('sender_id', $authUserId)
                    ->where('receiver_id', $user->id);
            })
                ->orWhere(function ($query) use ($authUserId, $user) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', $authUserId);
                })
                ->with([
                    'sender:id,firstName,lastName,avatar',
                    //! 'receiver:id,name,avatar',
                ])
                ->orderByDesc('id')
                ->get();

            return Helper::jsonResponse(true, 'Messages retrieved successfully', 200, MessageResource::collection($messages));
        } catch (Exception $e) {
            Log::error('Error retrieving messages: ' . $e->getMessage(), ['exception' => $e]);
            return Helper::jsonResponse(false, 'An error occurred while retrieving messages: ' . $e->getMessage(), 500);
        }
    }

    /**
     *! Send a message to another user
     *
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function SendMessage(User $user, Request $request): JsonResponse {
        try {
            $validatedData = $request->validate([
                'message'    => 'nullable|string',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mp3,mov,avi,doc,docx,pdf,xls,xlsx,txt|max:102400',
            ], [
                'attachment.mimes' => 'Only images, videos, audios and documents are allowed.',
                'attachment.max'   => 'The attachment must not be greater than 10MB.',
            ]);

            $attachmentPath = null;
            $attachmentName = null;
            $attachmentType = null;

            //? Handle file upload if present
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                //* Determine the attachment type
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'image/')) {
                    $attachmentType = 'image';
                } elseif (str_starts_with($mimeType, 'video/')) {
                    $attachmentType = 'video';
                } elseif (str_starts_with($mimeType, 'audio/')) {
                    $attachmentType = 'audio';
                } else {
                    $attachmentType = 'document';
                }

                //! Use the Helper::fileUpload method
                $attachmentPath = Helper::fileUpload($file, 'attachments');

                //* Store the original name of the file
                $attachmentName = $file->getClientOriginalName();
            }

            $message = Message::create([
                'sender_id'       => $request->user()->id,
                'receiver_id'     => $user->id,
                'text'            => $validatedData['message'] ?? null,
                'attachment_path' => $attachmentPath,
                'attachment_name' => $attachmentName,
                'attachment_type' => $attachmentType,
            ]);

            //* Broadcast the message
            broadcast(new MessageSent($message))->toOthers();

            return Helper::jsonResponse(true, 'Message sent successfully', 200, new MessageResource($message));
        } catch (Exception $e) {
            Log::error('Error sending message: ' . $e->getMessage(), ['exception' => $e]);
            return Helper::jsonResponse(false, 'An error occurred while sending the message.', 500);
        }
    }

    /**
     *? Get users with the last message between them and the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getUsersWithLastMessage(Request $request): JsonResponse {
        try {
            $authUser = $request->user();

            if (!$authUser) {
                return Helper::jsonResponse(false, 'User not authenticated', 401);
            }

            $userId = $authUser->id;

            $subQuery = Message::query()
                ->select('sender_id', DB::raw('MAX(id) as last_message_id'))
                ->where('receiver_id', $userId)
                ->where('sender_id', '!=', $userId)
                ->groupBy('sender_id');

            $messages = Message::query()
                ->joinSub($subQuery, 'latest_messages', function ($join) {
                    $join->on('messages.id', '=', 'latest_messages.last_message_id');
                })
                ->with('sender:id,firstName,lastName,avatar')
                ->orderByDesc('messages.id')
                ->get();

            return Helper::jsonResponse(true, 'Users with last message retrieved successfully', 200, MessageResource::collection($messages));
        } catch (Exception $e) {
            Log::error('Error retrieving users with last message: ' . $e->getMessage(), ['exception' => $e]);
            return Helper::jsonResponse(false, 'An error occurred while retrieving users with last message: ' . $e->getMessage(), 500);
        }
    }
}
