<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mt-4">
                        <a href="{{ route('projects.index') }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                           
                            Przejdź do projektów
                        </a>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 text-red-600 font-bold text-3xl">
    TEST DZIAŁA?
</div>

</x-app-layout>
