<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Vacations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        <thead>
                            <th>
                                Request status
                            </th>
                            <th>
                                Starting date
                            </th>
                            <th>
                                End date
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Project leader that approved
                            </th>
                        </thead>
                        <tbody>
                            @foreach($vacations as $vacation)
                            <tr>
                                <td>
                                    {{ $vacation->status }}
                                </td>
                                <td>
                                    {{ $vacation->start }}
                                </td>
                                <td>
                                    {{ $vacation->end }}
                                </td>
                                <td>
                                    {{ $vacation->description }}
                                </td>
                                <td>
                                    {{ $vacation->project_lead_approved }}
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
