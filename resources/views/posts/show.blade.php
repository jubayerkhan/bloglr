@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <h1>{{ $post->title }}</h1>
    <h3>By: {{ $post->author }}</h3>
    <p>{{ $post->body }}</p>
    <a class="bg-blue-400 px-3 py-1" href="{{ route('posts.index') }}">Back</a>
  </div>
@endsection