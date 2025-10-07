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
  </div>
@endsection
