@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="max-w-xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Create Task for Project: <span class="text-blue-600">{{ $project->name }}</span>
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.tasks.store', $project->id) }}" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
                <input type="text" name="title" id="title" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('title') }}">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="todo" {{ old('status') == 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select name="priority" id="priority" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label for="assigned_to_user_id" class="block text-sm font-medium text-gray-700 mb-1">Assign to User (optional)</label>
                <select name="assigned_to_user_id" id="assigned_to_user_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- None --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to_user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-xl shadow hover:bg-green-700 transition duration-200">
                Create Task
            </button>
        </form>
    </div>
@endsection
