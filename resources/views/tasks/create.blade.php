@extends('layouts.app')

@section('content')
    <h1>Create Task for Project: {{ $project->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Task</button>
    </form>
@endsection
