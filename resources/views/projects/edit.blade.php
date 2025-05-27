@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" name="name" value="{{ $project->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
