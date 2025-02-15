<?php

namespace App\Http\Controllers\API;

use App\Models\Replies;
use App\Models\Discussions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Replies\RepliesResource;
use App\Http\Requests\Discussions\DiscussionsRequest;
use App\Http\Resources\Discussions\DiscussionsResource;

class DiscussionsController extends Controller
{
    public function discussions(DiscussionsRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Anda harus login untuk membuat diskusi!',
            ], 401);
        }

        $discussion = Discussions::create([
            'courses_id' => $request->courses_id,
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Diskusi berhasil ditambahkan',
            'discussion' => new DiscussionsResource($discussion),
        ], 201);
    }

    public function replies(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Anda harus login untuk membuat replies',
            ], 401);
        }

        $discussion = Discussions::find($id);

        $replies = Replies::create([
            'discussions_id' => $discussion->id,
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        return response()->json([
           'status' => true,
           'message' => 'Reply berhasil ditambahkan',
           'reply' => new RepliesResource($replies),
        ], 201);


    }
}
