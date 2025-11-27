@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <h1>Create Post</h1>

    {{-- Opening the form using Spatie --}}
    {{ html()->form('POST', route('posts.store'))->open() }}

    @include('posts._form', ['buttonText' => 'Create Post'])

    {{-- Closing the form --}}
    {{ html()->form()->close() }}
  </div>
@endsection