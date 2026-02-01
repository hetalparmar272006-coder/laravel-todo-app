<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-600">TodoApp</a>

            <div class="flex items-center gap-4">
                <span class="text-gray-700 dark:text-gray-200">Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-10">
        {{ $slot }}
    </main>

</body>
</html>
