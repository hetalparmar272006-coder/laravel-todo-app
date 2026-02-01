<x-app-layout>
    <x-slot name="title">Edit Task</x-slot>

    <div class="max-w-xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Edit Task</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div id="alert-success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div id="alert-error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ old('title', $task->title) }}"
                   class="p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">

            <div class="flex gap-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded shadow transition hover:scale-105">
                    Update
                </button>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded shadow transition hover:scale-105">
                    Back
                </a>
            </div>
        </form>

    </div>

    <script>
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            if(success) success.style.display = 'none';
            const error = document.getElementById('alert-error');
            if(error) error.style.display = 'none';
        }, 2000);
    </script>

</x-app-layout>
