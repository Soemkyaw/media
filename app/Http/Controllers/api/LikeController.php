<?php

namespace App\Http\Controllers\api;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $post = Post::where('id', $request->post_id)->first();

        if ($post->isLiked($request->user_id)) {
            $post->likedByUser()->detach($request->user_id);
        } else {
            $post->likedByUser()->attach($request->user_id);
        }

        return response()->json([
            'status' => 200
        ], 200);
    }
}
