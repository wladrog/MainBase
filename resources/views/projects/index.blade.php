@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 text-center">
        <img src="{{ asset('images/teamcamp-logo.png') }}" alt="TeamCamp Logo" class="mx-auto mb-6 w-100">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('projects.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6">
            {{ __('Add Project') }}
        </a>

        @if ($projects->isEmpty())
            <p class="text-gray-500">{{ __('No projects yet.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach ($projects as $project)
                    <li class="bg-white shadow rounded p-4 flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-lg">{{ $project->name }}</p>
                            <p class="text-sm text-gray-600">{{ $project->description }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.tasks.index', $project->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">{{ __('Tasks') }}</a>
                            <a href="{{ route('projects.edit', $project->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">{{ __('Edit') }}</a>

                            @can('delete', $project)
                                <form method="POST" action="{{ route('projects.destroy', $project->id) }}"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">{{ __('Delete') }}</button>
                                </form>
                            @endcan
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Kalendarz świąt państwowych 2025 (Wolne od projektów)</h2>
            <div id="holiday-calendar" class="bg-white shadow rounded p-4 text-left space-y-2">
                <p class="text-gray-500">Ładowanie świąt...</p>
            </div>
        </div>

        @auth
            @if (Auth::user()->role === 'admin')
                <p class="mt-6 text-sm text-gray-600">{{ __('You are an administrator') }}</p>
            @endif
        @endauth
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const calendarContainer = document.getElementById('holiday-calendar');

        try {
            const response = await fetch('https://date.nager.at/api/v3/PublicHolidays/2025/PL');
            const holidays = await response.json();

            if (Array.isArray(holidays) && holidays.length > 0) {
                calendarContainer.innerHTML = '';

                holidays.forEach(holiday => {
                    const item = document.createElement('div');
                    item.className = 'border-b pb-2 mb-2';

                    const date = new Date(holiday.date);
                    const formattedDate = date.toLocaleDateString('pl-PL', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    item.innerHTML = `<strong>${formattedDate}</strong>: ${holiday.localName}`;
                    calendarContainer.appendChild(item);
                });
            } else {
                calendarContainer.innerHTML = '<p class="text-red-500">Brak danych o świętach.</p>';
            }
        } catch (error) {
            console.error(error);
            calendarContainer.innerHTML = '<p class="text-red-500">Nie udało się pobrać danych z API.</p>';
        }
    });
</script>
@endpush
