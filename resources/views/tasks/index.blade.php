@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">
            Tasks for project: <span class="text-blue-600">{{ $project->project_name }}</span>
        </h1>

        <a href="{{ route('projects.tasks.create', $project->id) }}"
           class="inline-block mb-6 bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 transition duration-200">
            ➕ Add Task
        </a>

        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Priority</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Assigned to</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold w-36">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $task->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($task->status)
                                    @case('todo')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">To Do</span>
                                        @break
                                    @case('in_progress')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-300 rounded-full">In Progress</span>
                                        @break
                                    @case('done')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-full">Done</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($task->priority)
                                    @case('low')
                                        <span class="text-sm text-gray-500">Low</span>
                                        @break
                                    @case('medium')
                                        <span class="text-sm text-blue-600">Medium</span>
                                        @break
                                    @case('high')
                                        <span class="text-sm text-red-600 font-semibold">High</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $task->assignedUser ? $task->assignedUser->name : '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-2">
                                    <a href="{{ route('tasks.edit', [$project->project_id, $task->id]) }}"
                                       class="px-3 py-1 rounded-md bg-blue-100 text-blue-800 hover:bg-blue-200 transition text-sm font-medium">
                                        Edit
                                    </a>

                                    @can('delete', $task)
                                        <form action="{{ route('tasks.destroy', [$project->project_id, $task->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 rounded-md bg-red-100 text-red-800 hover:bg-red-200 transition text-sm font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-6 italic">No tasks found for this project.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
