@extends('layouts.app')

@section('content')
    <div class="p-4 max-w-6xl mx-auto">
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->author }}</p>
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" width="400">
        @endif
        <p>{{ $blog->description }}</p>
        <a class="bg-blue-400 px-3 py-1 mt-2" href="{{ route('blogs.index') }}">Back</a>
        <h3 class="text-xl font-semibold mt-8 mb-4">Comments</h3>
        <!-- @foreach ( range(1, 10) as $btn )
            <button class="text-red-500 text-sm" onclick="return confirm('Delete this comment?')">Delete</button>
        @endforeach -->

        {{-- Show existing comments --}}
        @foreach ($blog->comments->sortByDesc('created_at') as $comment)
            <div class="border rounded-lg p-3 mb-2 bg-gray-50">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->content }}</p>
                <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

                @if (auth()->check() && (auth()->user()->usertype === 'admin' || auth()->id() === $comment->user_id))
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 text-sm" onclick="return confirm('Delete this comment?')">Delete</button>
                    </form>
                @endif
            </div>
        @endforeach

        {{-- Add new comment --}}
        @auth
            <form action="{{ route('comments.store', $blog) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="content" class="w-full border rounded-lg p-2" rows="3" placeholder="Write a comment..."
                    required></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Post Comment</button>
            </form>
        @else
            <p class="mt-4 text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to comment.</p>
        @endauth
    </div>
@endsection