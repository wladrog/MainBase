@extends('layouts.app')

@section('content')
    <h1>Projects</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>

    @if ($projects->isEmpty())
        <p>No projects yet.</p>
    @else
        <ul class="list-group">
            @foreach ($projects as $project)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $project->name }}</strong><br>
            <small>{{ $project->description }}</small>
        </div>
        <div>
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
            <form method="POST" action="{{ route('projects.destroy', $project->id) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </li>
@endforeach

        </ul>
    @endif
@endsection
