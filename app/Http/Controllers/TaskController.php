<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks()->latest()->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($request->only(['title', 'description']));

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task updated.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task deleted.');
    }
}
