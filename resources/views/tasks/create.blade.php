@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create Task for Project: {{ $project->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.tasks.store', $project->id) }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description (optional)</label>
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="todo">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="assigned_to_user_id" class="form-label">Assign to User (optional)</label>
                <input type="number" name="assigned_to_user_id" id="assigned_to_user_id" class="form-control" placeholder="User ID">
            </div>

            <button type="submit" class="btn btn-success">Create Task</button>
        </form>
    </div>
@endsection
