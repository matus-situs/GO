<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Employee Vacations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-success-message />
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
                                <td>
                                    <a href="{{ route('pending.approve', $vacation) }}">Approve</a>
                                </td>
                                <td>
                                    <a href="{{ route('pending.deny', $vacation) }}">Deny</a>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($leadervacations as $vacation)
                            <tr>
                                <td>
                                    {{ $projectleader->name }}
                                </td>
                                <td>
                                    {{ $projectleader->surname }}
                                </td>
                                <td>
                                    {{ $vacation->start }}
                                </td>
                                <td>
                                    {{ $vacation->end }}
                                </td>
                                <td>
                                    <a href="{{ route('pending.approve', $vacation) }}">Approve</a>
                                </td>
                                <td>
                                    <a href="{{ route('pending.deny', $vacation) }}">Deny</a>
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