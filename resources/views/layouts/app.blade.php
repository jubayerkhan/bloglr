<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Blog') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        {{-- Navigation --}}
        <nav class="bg-white shadow-md mb-8">
            <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">MyBlog</a>

                <div class="space-x-6">
                    <a href="{{ route('blogs.index') }}" class="hover:text-blue-500">Home</a>

                    @auth
                        <a href="{{ route('blogs.create') }}" class="hover:text-blue-500">Create</a>
                        <span class="text-gray-500">|</span>
                        <span class="text-gray-700">Hi, {{ Auth::user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-500">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-blue-500">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>
    </div>

    {{-- Footer --}}
    <footer class="mt-12 py-6 text-center text-gray-500 border-t">
        &copy; {{ date('Y') }} MyBlog. All rights reserved.
    </footer>
</body>

</html>