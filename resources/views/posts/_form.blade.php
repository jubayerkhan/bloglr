@csrf

<div>
  <label>Title</label>
  <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}">
  @error('title') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Author</label>
  <input type="text" name="author" value="{{ old('author', $post->author?? '') }}">
  @error('author') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Body</label>
  <textarea name="body">{{ old('body', $post->body ?? '') }}</textarea>
  @error('body') <div>{{ $message }}</div> @enderror
</div>

<button class="bg-blue-400 px-3 py-1" type="submit">{{ $buttonText ?? 'Save' }}</button>
