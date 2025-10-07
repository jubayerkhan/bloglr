<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->usertype == 'admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('User Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as user!") }}
                </div>

                {{-- ✅ These links will appear inside the white card --}}
                <div class="mb-4 ml-6 flex gap-3">
                    <a
                        href="{{ route('posts.index') }}"
                        class="inline-block px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:bg-gray-100 rounded-sm text-sm leading-normal"
                    >
                        Posts
                    </a>
                    <a
                        href="{{ route('blogs.index') }}"
                        class="inline-block px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:bg-gray-100 rounded-sm text-sm leading-normal"
                    >
                        Blogs
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
