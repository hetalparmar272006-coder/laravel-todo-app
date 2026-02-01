<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">Hello, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 dark:text-gray-300">Welcome to your Todo Dashboard.</p>
            </div>

            {{-- Tasks Summary --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                
                <div class="bg-blue-500 text-white p-4 rounded shadow">
                    <h4 class="font-bold text-lg">Total Tasks</h4>
                    <p class="text-2xl mt-2">{{ \App\Models\Task::where('user_id', Auth::id())->count() }}</p>
                </div>

                <div class="bg-green-500 text-white p-4 rounded shadow">
                    <h4 class="font-bold text-lg">Completed Tasks</h4>
                    <p class="text-2xl mt-2">{{ \App\Models\Task::where('user_id', Auth::id())->where('is_completed', true)->count() }}</p>
                </div>

                <div class="bg-yellow-500 text-white p-4 rounded shadow">
                    <h4 class="font-bold text-lg">Pending Tasks</h4>
                    <p class="text-2xl mt-2">{{ \App\Models\Task::where('user_id', Auth::id())->where('is_completed', false)->count() }}</p>
                </div>

            </div>

            {{-- Go to Tasks Button --}}
            <div>
                <a href="{{ route('tasks.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded shadow mt-4 inline-block transition hover:scale-105">
                    Go to My Todo List
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
