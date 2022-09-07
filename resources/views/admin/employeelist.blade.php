<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee list') }}
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
                                Email
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Vacation days
                            </th>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            @if (!($employee->name == Auth::user()->name && $employee->email == Auth::user()->email))
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
                                    {{ $employee->role }}
                                </td>
                                <td>
                                    {{ $employee->remaining_vacation }}
                                </td>
                                <td>
                                    <a href="{{ route('employeelist.edit', $employee) }}">Edit</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
