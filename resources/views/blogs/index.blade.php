@extends('layouts.app')

@section('content')
  <form action="{{ route('blogs.index') }}" method="get" class="mb-5 max-w-6xl mx-auto pt-5">
    <div class="flex items-center gap-2">
      <input type="text" name="search" placeholder="search blog..." value="{{ request('search') }}"
        class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
        Search
      </button>
    </div>
  </form>
  <div class="p-4 max-w-6xl mx-auto">
    <h1 class="mb-5 text-2xl">Blogs All</h1>
    <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.create') }}">New Post</a>
  </div>

  @foreach($blogs as $blog)
    <article class="p-4 max-w-6xl mx-auto">
      <h2><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h2>
      <h3>By: {{ $blog->author }}</h3>
      <h3>Account Holder: {{ $blog->user->name }}</h3>
      <h3>Account Holder Email ID: {{ $blog->user->email }}</h3>
      @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image)}}" alt="{{ $blog->title }}" width="400" />
      @endif
      <p>{{ \Illuminate\Support\Str::limit($blog->description, 120) }}</p>
      <p class="mb-2">Created at: {{ $blog->created_at->format('Y-m-d H:i') }}</p>
      <!-- <p> updated at: {{$blog->updated_at}}</p> -->

      @can('update', $blog)
        <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.edit', $blog) }}">Edit</a>
      @endcan

      <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.show', $blog) }}">View</a>

      @can('delete', $blog)
        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline">
          @csrf
          @method('DELETE')
          <button class="bg-blue-400 px-3 py-1" type="submit" onclick="return confirm('Delete?')">Delete</button>
        </form>
      @endcan
      {{-- Show existing comments --}}
      @foreach ($blog->comments->sortByDesc('created_at')->take(2) as $comment)
        <div class="border rounded-lg p-3 mb-2 bg-gray-50 mt-5">
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

    </article>
  @endforeach

  <div class="pb-5 max-w-6xl mx-auto">
    {{ $blogs->links() }}
  </div>
@endsection