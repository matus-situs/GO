<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My team') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <table>
                        <thead>
                            <th>
                                Name
                            </th>
                            <th>
                                Leader
                            </th>
                            <th>
                                Project
                            </th>
                            <th>
                                Team members
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $team->name }}
                                </td>
                                <td>
                                    {{ $team->leader }}
                                </td>
                                <td>
                                    {{ $team->project }}
                                </td>
                                <td>
                                    @foreach($employees as $employee)
                                    {{ $employee->name }} {{ $employee->surname }}, 
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
