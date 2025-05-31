<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->bugs()->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'issue_link' => 'nullable|string'
        ]);

        $validated['reported_by_user_id'] = auth()->id();
        $validated['project_id'] = $project->project_id;

        Task::create($validated);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task created.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'issue_link' => 'nullable|string'
        ]);

        $task->update($validated);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task updated.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Task deleted.');
    }
}