<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Show all tasks of logged-in user only
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store Task (Validation + Secure Insert)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task Added Successfully!');
    }

    /**
     * Edit Task Page (Owner Only)
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, "Unauthorized Access!");
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update Task (Owner Only + Validation)
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task Updated Successfully!');
    }

    /**
     * Complete Task (Owner Only)
     */
    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'is_completed' => true,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task Marked Completed!');
    }

    /**
     * Delete Task (Owner Only)
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task Deleted Successfully!');
    }
}
