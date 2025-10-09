<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog){
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'blog_id' => $blog->id,
            'content' => $request->input('content'),
        ]);

        return back();
    }

    public function destroy(Comment $comment){
        if(auth()->user()->usertype === 'admin' || auth()->id() === $comment->user_id){
            $comment->delete();
            return back();
        }
        abort(403, 'Unauthorized action.');
    }
}
