@csrf

<div>
  <label>Title</label>
  <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}">
  @error('title') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Body</label>
  <textarea name="body">{{ old('body', $post->body ?? '') }}</textarea>
  @error('body') <div>{{ $message }}</div> @enderror
</div>

<button type="submit">{{ $buttonText ?? 'Save' }}</button>
