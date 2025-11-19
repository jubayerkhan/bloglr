@extends('layouts.app')

@section('content')
  <h1>{{ $post->title }}</h1>
  <h3>By: {{ $post->author }}</h3>
  <p>{{ $post->body }}</p>
  <a class="bg-blue-400 px-3 py-1" href="{{ route('posts.index') }}">Back</a>
@endsection
