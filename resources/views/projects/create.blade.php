@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Create Project</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
            @csrf

            <div>
    <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
    <input type="text" name="project_name" id="project_name" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>


            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description (optional)</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            

            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create</button>
        </form>
    </div>
@endsection
