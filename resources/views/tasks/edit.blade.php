@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Task: <strong>{{ $task->title }}</strong></h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', [$project->project_id, $task->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority" class="form-select" required>
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to_user_id" class="form-label">Assign to User (optional)</label>
            <input type="number" name="assigned_to_user_id" id="assigned_to_user_id" class="form-control" value="{{ old('assigned_to_user_id', $task->assigned_to_user_id) }}" placeholder="User ID">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Save Changes</button>
            <a href="{{ route('projects.tasks.index', $project->project_id) }}" class="btn btn-secondary">↩️ Back</a>
        </div>
    </form>
</div>
@endsection
