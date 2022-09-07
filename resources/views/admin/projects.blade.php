<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
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
                                Project started
                            </th>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>
                                    {{ $project->name }}
                                </td>
                                <td>
                                    {{ $project->leader }}
                                </td>
                                <td>
                                    {{ $project->created_at }}
                                </td>
                                <td>
                                    <a href="{{ route('projects.edit', $project) }}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
