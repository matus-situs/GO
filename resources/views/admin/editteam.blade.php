<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit team') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-success-message/>
                <form method="POST" action="{{ route('teams.update', $team) }}">
                        @method("PUT")
                        @csrf

                        <div>
                            <x-input id="id" type="hidden" name="id" value="{{ $team->id }}" />
                        </div>
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $team->name }}" />
                        </div>

                        <div>
                            <x-label for="leader" :value="__('Team leader')"/>
                            <select name="leader" id="leader">
                            @foreach($leaders as $leader)
                            @if($leader->name == $team->leader)
                                <option value="{{ $leader->id }}" selected="selected">{{ $leader->name }}</option>
                            @else
                                <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="project" :value="__('Project')" />

                            <x-input id="project" class="block mt-1 w-full" type="text" name="project" value="{{ $team->project }}" disabled/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Save changes') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
