@extends('layouts.app')

@section('content')
  <h1>Create Post</h1>

  <form action="{{ route('posts.store') }}" method="POST">
    @include('posts._form', ['buttonText' => 'Create Post'])
  </form>
@endsection
