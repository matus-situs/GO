<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Vacation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <x-success-message/>

                    <form method="POST" action="{{ route('projectleadervacations.request') }}">
                        @csrf

                        <div>
                            <x-label for="start" :value="__('Starting date')" />

                            <x-input id="start" class="block mt-1 w-full" type="date" name="start" required autofocus />
                        </div>

                        <div>
                            <x-label for="end" :value="__('End date')" />

                            <x-input id="end" class="block mt-1 w-full" type="date" name="end" required autofocus />
                        </div>

                        <div>
                            <x-label for="description" :value="__('Description')" />

                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Submit request') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
