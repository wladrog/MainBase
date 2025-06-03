@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="max-w-2xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Task: <span class="text-blue-600">{{ $task->title }}</span></h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.update', $task) }}">

            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="w-full border rounded px-3 py-2 mt-1" value="{{ old('title', $task->title) }}" required>
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3" class="w-full border rounded px-3 py-2 mt-1">{{ old('description', $task->description) }}</textarea>
            </div>

            <div>
                <label for="status" class="block font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div>
                <label for="priority" class="block font-medium text-gray-700">Priority</label>
                <select id="priority" name="priority" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label for="assigned_to_user_id" class="block font-medium text-gray-700">Assigned User ID</label>
                <input type="number" id="assigned_to_user_id" name="assigned_to_user_id" class="w-full border rounded px-3 py-2 mt-1" value="{{ old('assigned_to_user_id', $task->assigned_to_user_id) }}" placeholder="e.g. 5">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Save</button>
                <a href="{{ route('projects.show', $task->project_id) }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
@endsection
