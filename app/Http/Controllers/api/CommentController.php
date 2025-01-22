<?php

namespace App\Http\Controllers\api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::where('post_id', $request->post_id)->get();

        return response()->json([
            'comments' => $comments
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => ['required','string','min:3'],
            'user_id' => ['required','exists:users,id'],
            'post_id' => ['required','exists:posts,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        Comment::create([
            'content' => $request->content,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'message' => 'new comment created...',
            'status' => 200
        ], 200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Commend has been deleted...',
            'status' => 200
        ], 200);
    }
}
