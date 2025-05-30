@extends('layouts.app')

@section('content')
    <h1>Tasks for project: {{ $project->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary mb-3">Add Task</a>

    @if ($tasks->isEmpty())
        <p>No tasks yet.</p>
    @else
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong><br>
                        <small>{{ $task->description }}</small>
                    </div>
                    <div>
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
