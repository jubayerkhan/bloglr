@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold p-4">Create Blog</h1>

  <form class="pl-4" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
    @include('blogs._form', ['buttonText' => 'Create Post'])
  </form>
@endsection
