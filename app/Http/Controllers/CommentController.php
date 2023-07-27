<?php

namespace App\Http\Controllers;

use App\Models\Comment;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required',
            'comment_content' => 'required'
        ]);

        $validate['user_id'] = auth()->user()->id;
        $comment = Comment::create($validate);

        return response()->json($comment);

    }

    public function update(Request $request)
    {

        $validate = $request->validate([
            'post_id' => 'required',
            'comment_content' => 'required'
        ]);

        $validate['user_id'] = auth()->user()->id;
        $comment = Comment::findOrFail($request->id);

        $comment->update($validate);

        return response()->json($comment);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json($comment);
    }
}
