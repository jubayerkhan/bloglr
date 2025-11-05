<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Blog $blog)
    {
        $user = Auth::user();

        if ($user->likedBlogs()->where('blog_id', $blog->id)->exists()) {
            $user->likedBlogs()->detach($blog->id);
            $status = 'unliked';
        } else {
            $user->likedBlogs()->attach($blog->id);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'likes_count' => $blog->likedByUsers()->count(),
        ]);
    }
}
