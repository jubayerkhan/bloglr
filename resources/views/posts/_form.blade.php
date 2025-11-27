@csrf

<div>
    {{ html()->label('Title', 'title') }}

    {{ html()->text('title')->class('border p-2 w-full') }}

    @error('title')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>

<div class="mt-4">
    {{ html()->label('Author', 'author') }}

    {{ html()->text('author')->class('border p-2 w-full') }}

    @error('author')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>

<div class="mt-4">
    {{ html()->label('Body', 'body') }}

    {{ html()->textarea('body')->value(old('body', $post->body ?? ''))->class('border p-2 w-full') }}

    @error('body')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>

{{ 
    html()->submit($buttonText ?? 'Save')->class('bg-blue-400 text-white px-3 py-1 mt-4 inline-block') 
}}
