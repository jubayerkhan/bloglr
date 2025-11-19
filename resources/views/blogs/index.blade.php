@extends('layouts.app')

@section('content')
  <form action="{{ route('blogs.index') }}" method="get" class="mb-5 max-w-6xl mx-auto pt-5">
    <div class="flex items-center gap-2">
      <input type="text" name="search" placeholder="search blog..." value="{{ request('search') }}"
        class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
        Search
      </button>
    </div>
  </form>
  <div class="p-4 max-w-6xl mx-auto">
    <h1 class="mb-5 text-2xl">Blogs</h1>
    <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.create') }}">New Post</a>
  </div>

  @foreach($blogs as $blog)
    <article class="p-4 max-w-6xl mx-auto">
      <!-- <h3> {{ $blog->user }}</h3> -->
      <h2><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h2>
      <h3>By: {{ $blog->author }}</h3>
      <h3>Account Holder: {{ $blog->user->name }}</h3>
      <h3>Account Holder Email ID: {{ $blog->user->email }}</h3>
      @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image)}}" alt="{{ $blog->title }}" width="400" />
      @endif
      <p>{{ \Illuminate\Support\Str::limit($blog->description, 120) }}</p>
      <p class="mb-2">Created at: {{ $blog->created_at->format('Y-m-d H:i') }}</p>
      <div class="flex items-center gap-3 my-2">
        <form action="{{ route('blogs.like', $blog->id) }}" method="POST" class="like-form" data-blog-id="{{ $blog->id }}">
          @csrf
          @if(!auth()->check())
            <button class="like-btn bg-gray-300 text-gray-700 px-3 py-1 rounded">
              🤍 Like
            </button>
          @else
            <button type="submit" data-blog-id="{{ $blog->id }}" class="like-btn text-sm px-3 py-1 rounded transition
                            {{ auth()->check() && $blog->likedByUsers->contains(auth()->id())
            ? 'bg-red-500 text-white'
            : 'bg-gray-300 text-gray-700' }}">
              ❤️ {{ $blog->likedByUsers->contains(auth()->id()) ? 'Unlike' : 'Like' }}
            </button>
          @endif
        </form>
        <span class="text-gray-600 text-sm mb-3">
          <span id="likes-count-{{ $blog->id }}">{{ $blog->likedByUsers->count() }}</span> Likes
        </span>
      </div>


      <!-- <p> updated at: {{$blog->updated_at}}</p> -->

      @can('update', $blog)
        <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.edit', $blog) }}">Edit</a>
      @endcan

      <a class="bg-blue-400 px-3 py-2" href="{{ route('blogs.show', $blog) }}">View</a>

      @can('delete', $blog)
        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline">
          @csrf
          @method('DELETE')
          <button class="bg-blue-400 px-3 py-1" type="submit" onclick="return confirm('Delete?')">Delete</button>
        </form>
      @endcan
      {{-- Show existing comments --}}
      @foreach ($blog->comments->sortByDesc('created_at')->take(2) as $comment)
        <div class="border rounded-lg p-3 mb-2 bg-gray-50 mt-5">
          <strong>{{ $comment->user->name }}</strong>
          <p>{{ $comment->content }}</p>
          <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

          @if (auth()->check() && (auth()->user()->usertype === 'admin' || auth()->id() === $comment->user_id))
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button class="text-red-500 text-sm" onclick="return confirm('Delete this comment?')">Delete</button>
            </form>
          @endif
        </div>
      @endforeach

    </article>
  @endforeach

  <div class="pb-5 max-w-6xl mx-auto">
    {{ $blogs->links() }}
  </div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.like-btn').forEach(button => {
      button.addEventListener('click', async (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();

        const blogId = button.dataset.blogId;
        const countEl = document.getElementById(`likes-count-${blogId}`);

        try {
          const response = await fetch(`/blogs/${blogId}/like`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json'
            }
          });

          // 🛑 If not logged in (401)
          if (response.status === 401) {
            alert("Please login first!");
            return;
          }

          const data = await response.json();

          // Update button
          if (data.status === 'liked') {
            button.textContent = `❤️ Unlike (${data.likes_count})`;
            button.classList.remove('bg-gray-300', 'text-gray-700');
            button.classList.add('bg-red-500', 'text-white');
          } else {
            button.textContent = `🤍 Like (${data.likes_count})`;
            button.classList.remove('bg-red-500', 'text-white');
            button.classList.add('bg-gray-300', 'text-gray-700');
          }

          // Update count
          if (countEl) {
            countEl.textContent = data.likes_count;
          }

        } catch (error) {
          console.error('Error:', error);
        }
      });
    });
  });
</script>