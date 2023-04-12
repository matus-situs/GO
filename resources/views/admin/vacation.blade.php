<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!--<table>
                        <thead>
                            <th>
                                Status
                            </th>
                            <th>
                                Employee name
                            </th>
                            <th>
                                Employee surname
                            </th>
                            <th>
                                Start
                            </th>
                            <th>
                                End
                            </th>
                            <th>
                                Team lead approved
                            </th>
                            <th>
                                Project lead approved
                            </th>
                        </thead>
                        <tbody>
                        @foreach($vacations as $vacation)
                        <tr>
                            <td>
                                {{ $vacation->status }}
                            </td>
                            <td>
                                {{ $vacation->name }}
                            </td>
                            <td>
                                {{ $vacation->surname }}
                            </td>
                            <td>
                                {{ $vacation->start }}
                            </td>
                            <td>
                                {{ $vacation->end }}
                            </td>
                            <td>
                                {{ $vacation->team_lead_approved }}
                            </td>
                            <td>
                                {{ $vacation->project_lead_approved }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
</table>
                    {{ $vacations->links() }}-->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
