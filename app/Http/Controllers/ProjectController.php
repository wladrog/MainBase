<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        Log::info('Dodano nowy projekt przez użytkownika: ' . $request->user()->email);

        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Request $request, Project $project)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'Brak uprawnień do usuwania projektów.');
        }

        logger('Deleting project: ' . $project->id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
