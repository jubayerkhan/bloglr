<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $blogs = Blog::with('user')
        ->when($search, function ($query, $search) {
             $query->where(function($q) use ($search){
                $q->where('title', 'like', "%{$search}%")
                ->orWhere("description", "like", "%{$search}%")
                ->orWhere("user_id", "like", "%{$search}%")
                ->orWhere("author", "like", "%{$search}%")
                ->orWhereHas('user', function($q2) use ($search){
                    $q2->where('email', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function($q2) use ($search){
                    $q2->where('name', 'like', "%{$search}%");
                });
             });
        })
        ->latest()
        ->paginate(3)
        ->withQueryString();
        return view('blogs.index', compact('blogs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        if ($request->hasfile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        // associate blog with the authenticated user
        $data['user_id'] = auth()->id();

        Blog::create($data);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        if ($request->hasfile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }


        $blog->update($data);
        return view('blogs.show', compact('blog'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);
        $blog->delete();
        return redirect()->route('blogs.index');
    }
}
