@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tasks for project: <strong>{{ $project->project_name }}</strong></h1>

    <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-primary mb-3">➕ Add Task</a>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Assigned to</th>
                        <th scope="col" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>
                                @switch($task->status)
                                    @case('todo') <span class="badge bg-secondary">To Do</span> @break
                                    @case('in_progress') <span class="badge bg-warning text-dark">In Progress</span> @break
                                    @case('done') <span class="badge bg-success">Done</span> @break
                                @endswitch
                            </td>
                            <td>
                                @switch($task->priority)
                                    @case('low') <span class="text-muted">Low</span> @break
                                    @case('medium') <span class="text-primary">Medium</span> @break
                                    @case('high') <span class="text-danger">High</span> @break
                                @endswitch
                            </td>
                            <td>{{ $task->assignedUser ? $task->assignedUser->username : '—' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('tasks.edit', [$project->project_id, $task->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>

                                    <form action="{{ route('tasks.destroy', [$project->project_id, $task->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No tasks found for this project.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
