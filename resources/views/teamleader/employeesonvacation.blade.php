<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees on vacation') }}
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
                                Surname
                            </th>
                            <th>
                                Start
                            </th>
                            <th>
                                End
                            </th>
                        </thead>
                        <tbody>
                            @foreach($vacations as $vacation)
                            <tr>
                                @foreach($employees as $employee)
                                @if($employee->id == $vacation->employee)
                                <td>
                                    {{ $employee->name }}
                                </td>
                                <td>
                                    {{ $employee->surname }}
                                </td>
                                @endif
                                @endforeach
                                <td>
                                    {{ $vacation->start }}
                                </td>
                                <td>
                                    {{ $vacation->end }}
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
