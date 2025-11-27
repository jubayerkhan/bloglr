@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <h1>Edit Post</h1>

    {{-- Opening the form using Spatie --}}
   {{ html()->model($post)->form('PATCH')->route('posts.update', $post->id)->open() }}
      @include('posts._form', ['buttonText' => 'Update Post'])
    {{-- Closing the form --}}
    {{ html()->form()->close() }}

    {{-- Original HTML form for reference --}}

    <!-- <form action="{{ route('posts.update', $post) }}" method="POST">
        @method('PUT')
        @include('posts._form', ['buttonText' => 'Update Post'])
      </form> -->
  </div>
@endsection