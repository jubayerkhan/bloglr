@extends('layouts.app')

@section('content')
  <h1>Edit Blog</h1>

  <form class="p-4" action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('blogs._form', ['buttonText' => 'Update Blog'])
  </form>
@endsection
