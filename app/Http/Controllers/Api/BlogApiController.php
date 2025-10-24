<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogApiController extends Controller
{
    // Get all blogs (with search + pagination)
    public function index(Request $request)
    {
        $search = $request->input('search');

        $blogs = Blog::with('user')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5);

        return response()->json($blogs);
    }

    // Get single blog
    public function show(Blog $blog)
    {
        return response()->json($blog->load('user', 'comments'));
    }

    // Create new blog (requires login)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return response()->json($blog, 201);
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        // Optional: Check ownership
        if (Auth::id() !== $blog->user_id && Auth::user()->usertype !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $blog->update($request->all());

        return response()->json($blog);
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        if (Auth::id() !== $blog->user_id && Auth::user()->usertype !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted']);
    }
}
