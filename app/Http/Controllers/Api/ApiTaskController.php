<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class ApiTaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return response()->json([
            'message' => 'Task list',
            'tasks' => $tasks
        ]);
    }
}
