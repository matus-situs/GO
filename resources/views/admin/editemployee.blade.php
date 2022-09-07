<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit employee') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-success-message/>
                <form method="POST" action="{{ route('employeelist.update') }}">
                        @method("PUT")
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $employee->name }}" disabled />
                        </div>

                        <div>
                            <x-label for="surname" :value="__('Surname')" />

                            <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" value="{{ $employee->surname }}" disabled />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $employee->email }}" readonly/>
                        </div>

                        <div class="mt-4">
                            <x-label for="vacation" :value="__('Vacation')" />

                            <x-input id="vacation" class="block mt-1 w-full" type="text" name="vacation" value="{{ $employee->remaining_vacation }}" disabled/>
                        </div>

                        <div class="mt-4">
                            <x-label for="role" :value="__('Role')" />

                            <x-input id="role" class="block mt-1 w-full" type="text" name="role" value="{{ $employee->role }}"/>
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
