<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team members') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                {{ __('Team name: '. $team->name) }}<br>
                {{ __('Members:') }}
                <table>
                    <thead>
                        <th>
                            Name
                        </th>
                        <th>
                            Surname
                        </th>
                        <th>
                            Email
                        </th>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                        <td>
                            {{ $employee->name }}
                        </td>
                        <td>
                            {{ $employee->surname }}
                        </td>
                        <td>
                            {{ $employee->email }}
                        </td>
                        <td>
                            <a href="{{ route('teams.removemember', $employee) }}">Remove member</a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
