<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Blog $blog)
    {
        // 🛑 Step 1: Check if the user is NOT logged in
        if (!auth()->check()) {
            return response()->json([
                'error' => 'Please login first.'
            ], 401); // 401 = Unauthenticated
        }

        // Step 2: Continue normally if logged in
        $user = auth()->user();

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
