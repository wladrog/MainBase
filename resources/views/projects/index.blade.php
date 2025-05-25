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
                <li class="list-group-item">
                    <strong>{{ $project->name }}</strong><br>
                    <small>{{ $project->description }}</small>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
