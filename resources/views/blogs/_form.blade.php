@csrf

<div>
  <label>Title:</label>
  <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}">
  @error('title') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Author:</label>
  <input type="text" name="author" value="{{ old('author', $blog->author ?? '') }}">
  @error('author') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Description:</label>
  <textarea name="description">{{ old('description', $blog->description ?? '') }}</textarea>
  @error('description') <div>{{ $message }}</div> @enderror
</div>

<div>
  <label>Image:</label>
  <input type="file" name="image">
  @error('image') <div>{{ $message }}</div> @enderror
</div>

<button class="bg-blue-400 px-3 py-1 mt-2" type="submit">{{ $buttonText ?? 'Save' }}</button>
