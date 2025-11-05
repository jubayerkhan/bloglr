<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Toggle like
    public function toggleLike(Blog $blog)
    {
        $user = Auth::user();

        if ($user->likedBlogs()->where('blog_id', $blog->id)->exists()) {
            // If already liked, unlike it
            $user->likedBlogs()->detach($blog->id);
            return response()->json(['message' => 'Unliked']);
        } else {
            // Otherwise, like it
            $user->likedBlogs()->attach($blog->id);
            return response()->json(['message' => 'Liked']);
        }
    }

    // Get total likes of a blog
    public function likesCount(Blog $blog)
    {
        $count = $blog->likedByUsers()->count();
        return response()->json(['likes' => $count]);
    }

    // Get all blogs liked by the logged-in user
    public function myLikes()
    {
        $likedBlogs = Auth::user()->likedBlogs()->with('user')->get();
        return response()->json($likedBlogs);
    }
}
