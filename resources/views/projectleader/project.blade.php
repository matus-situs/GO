<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Name: {{ $project->name }}<br>
                    Team: {{ $team->name }}<br>
                    Team leader: {{ $team->leader }}<br>
                    Team members: 
                    @foreach($employees as $employee)
                    {{ $employee->name }} {{ $employee->surname }},
                    @endforeach<br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
