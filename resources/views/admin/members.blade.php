<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add member') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-success-message/>
                <form method="POST" action="{{ route('teams.addmember') }}">
                        @method("PUT")
                        @csrf

                        <x-input id="team_id" type="hidden" name="team_id" value="{{ $team->id }}"/>

                        <div class="mt-4">
                            <x-label for="team" :value="__('Team')" />

                            <x-input id="team" class="block mt-1 w-full" type="text" name="team" value="{{ $team->name }}" disabled/>
                        </div>

                        <div class="mt-4">
                            <x-label for="leader" :value="__('Team leader')" />

                            <x-input id="leader" class="block mt-1 w-full" type="text" name="leader" value="{{ $team->leader }}" disabled/>
                        </div>

                        <div class="mt-4">
                            <x-label for="project" :value="__('Project')" />

                            <x-input id="project" class="block mt-1 w-full" type="text" name="project" value="{{ $team->project }}" disabled/>
                        </div>

                        <div>
                            <x-label for="employee" :value="__('Employee to add')"/>
                            <select name="employee" id="employee">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" selected="selected">{{ $employee->name }} - {{ $employee->role }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Add member') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
