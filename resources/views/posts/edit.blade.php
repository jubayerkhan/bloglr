@extends('layouts.app')

@section('content')
  <h1>Edit Post</h1>

  <form action="{{ route('posts.update', $post) }}" method="POST">
    @method('PUT')
    @include('posts._form', ['buttonText' => 'Update Post'])
  </form>
@endsection
