@extends('layouts.app')

@section('content')
  <div class="p-4 max-w-6xl mx-auto">
    <h1 class="mb-2">Posts</h1>
    <a class="bg-blue-400 px-3 py-2" href="{{ route('posts.create') }}">New Post</a>
  </div>

  @foreach($posts as $post)
    <article class="p-4 max-w-6xl mx-auto">
      <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
      <p>{{ \Illuminate\Support\Str::limit($post->body, 120) }}</p>
      <p class="mb-2">Created at: {{ $post->created_at->format('Y-m-d H:i') }}</p>
      <!-- <p> updated at: {{$post->updated_at}}</p> -->

      <a class="bg-blue-400 px-3 py-2" href="{{ route('posts.edit', $post) }}">Edit</a>

      <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button class="bg-blue-400 px-3 py-1" type="submit" onclick="return confirm('Delete?')">Delete</button>
      </form>
    </article>
  @endforeach

  {{ $posts->links() }}
@endsection
