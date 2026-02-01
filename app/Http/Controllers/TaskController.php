<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|max:255']);

        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['title' => 'required|max:255']);

        $task->update(['title' => $request->title]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function complete(Task $task)
    {
        $task->update(['is_completed' => true]);
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
