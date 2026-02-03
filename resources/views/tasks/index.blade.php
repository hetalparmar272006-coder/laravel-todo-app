<x-app-layout>
    <x-slot name="title">My Tasks</x-slot>

    <div class="max-w-4xl mx-auto py-10">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">
                My Todo List
            </h1>

            <a href="{{ route('dashboard') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow transition hover:scale-105">
               Dashboard
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div id="alert-success"
                 class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div id="alert-error"
                 class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add Task --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-2 mb-6">
            @csrf

            <input type="text" name="title" placeholder="Enter new task"
                   class="flex-1 p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">

            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded shadow transition hover:scale-105">
                Add Task
            </button>
        </form>

        {{-- Task List --}}
        <ul class="space-y-4">
            @foreach($tasks as $task)

                <li class="bg-white dark:bg-gray-800 p-4 rounded shadow flex justify-between items-center transition transform hover:scale-105 hover:shadow-lg
                    {{ $task->is_completed ? 'opacity-60 line-through' : '' }}">

                    {{-- XSS Protection --}}
                    <span class="text-gray-800 dark:text-gray-200">
                        {{ $task->title }}
                    </span>

                    <div class="flex gap-2">

                        @if(!$task->is_completed)
                            <a href="{{ route('tasks.complete', $task->id) }}"
                               class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm shadow transition hover:scale-105">
                                Complete
                            </a>
                        @endif

                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm shadow transition hover:scale-105">
                            Edit
                        </a>

                        {{-- Secure Delete --}}
                        <form action="{{ route('tasks.destroy', $task->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this task?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm shadow transition hover:scale-105">
                                Delete
                            </button>
                        </form>

                    </div>
                </li>

            @endforeach
        </ul>

    </div>

    <script>
        // Auto-hide messages after 2 seconds
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            if(success) success.style.display = 'none';

            const error = document.getElementById('alert-error');
            if(error) error.style.display = 'none';
        }, 2000);
    </script>

</x-app-layout>
