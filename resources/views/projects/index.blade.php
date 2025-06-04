@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 text-center">
        <img src="{{ asset('images/teamcamp-logo.png') }}" alt="TeamCamp Logo" class="mx-auto mb-6 w-100">

        <h1 class="text-2xl font-bold mb-4">Projects</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('projects.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6">Add Project</a>

        @if ($projects->isEmpty())
            <p class="text-gray-500">No projects yet.</p>
        @else
            <ul class="space-y-4">
                @foreach ($projects as $project)
                    <li class="bg-white shadow rounded p-4 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-lg">{{ $project->name }}</p>
                            <p class="text-sm text-gray-600">{{ $project->description }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.tasks.index', $project->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Tasks</a>
                            <a href="{{ route('projects.edit', $project->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form method="POST" action="{{ route('projects.destroy', $project->id) }}"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
                   @auth
    @if (Auth::user()->role === 'admin')
        <p>Jesteś administratorem</p>
    @endif
@endauth
            </ul>
        @endif
     

    </div>
@endsection
