<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $tasks = $project->tasks()->with('assignedUser')->get();

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        $users = User::all();

        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);

        Task::create([
            'project_id' => $projectId,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'assigned_to_user_id' => $request->assigned_to_user_id,
        ]);

        return redirect()->route('projects.tasks.index', $projectId)->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $project = $task->project;
        $users = User::all(); 
        return view('tasks.edit', compact('task', 'project', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($request->only([
            'title', 'description', 'status', 'priority', 'assigned_to_user_id'
        ]));

        return redirect()->route('projects.tasks.index', $task->project_id)->with('success', 'Task updated.');
    }

    public function destroy(Request $request, Task $task)
    {
        $user = $request->user();

        if (!in_array($user->role, ['admin', 'manager'])) {
            return redirect()->route('projects.tasks.index', $task->project_id)
                ->with('error', 'Brak uprawnień do usuwania zadań.');
        }

        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.tasks.index', $projectId)->with('success', 'Task deleted.');
    }
}
