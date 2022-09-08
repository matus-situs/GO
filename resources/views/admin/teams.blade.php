<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams') }}
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
                                Team size
                            </th>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
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
                                    {{ $team->size }}
                                </td>
                                <td>
                                    <a href="{{ route('teams.showmembers', $team) }}">Show team members</a>
                                </td>
                                <td>
                                    <a href="{{ route('teams.edit', $team) }}">Edit team</a>
                                </td>
                                <td>
                                    <a href="{{ route('teams.members', $team) }}">Add member</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $teams->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
