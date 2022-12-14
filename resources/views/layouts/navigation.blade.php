<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (Auth::user()->role == "admin")
                    <x-nav-link :href="route('employeelist.index')" :active="request()->routeIs('employeelist.index')">
                        {{ __('Employees list') }}
                    </x-nav-link>
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">
                        {{ __('Projects') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teams.index')" :active="request()->routeIs('teams.index')">
                        {{ __('Teams') }}
                    </x-nav-link>
                    <x-nav-link :href="route('addemployee')" :active="request()->routeIs('addemployee')">
                        {{ __('Add Employee') }}
                    </x-nav-link>
                    <x-nav-link :href="route('addproject.index')" :active="request()->routeIs('addproject.index')">
                        {{ __('Add Project') }}
                    </x-nav-link>
                    <x-nav-link :href="route('addteams.index')" :active="request()->routeIs('addteams.index')">
                        {{ __('Create team') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employeesvacation.index')" :active="request()->routeIs('employeesvacation.index')">
                        {{ __('Employees on vacation') }}
                    </x-nav-link>
                    @endif
                    @if (Auth::user()->role == "employee")
                    <x-nav-link :href="route('employeeteam.index')" :active="request()->routeIs('employeeteam.index')">
                        {{ __('My team') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employeeproject.index')" :active="request()->routeIs('employeeproject.index')">
                        {{ __('Team project') }}
                    </x-nav-link>
                    <x-nav-link :href="route('myvacations.index')" :active="request()->routeIs('myvacations.index')">
                        {{ __('My Vacations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('newvacation')" :active="request()->routeIs('newvacation')">
                        {{ __('Request Vacation') }}
                    </x-nav-link>
                    @endif
                    @if (Auth::user()->role == "team leader")
                    <x-nav-link :href="route('leaderteam.index')" :active="request()->routeIs('leaderteam.index')">
                        {{ __('My team') }}
                    </x-nav-link>
                    <x-nav-link :href="route('leaderproject.index')" :active="request()->routeIs('leaderproject.index')">
                        {{ __('Project') }}
                    </x-nav-link>
                    <x-nav-link :href="route('myvacationstl.index')" :active="request()->routeIs('myvacationstl.index')">
                        {{ __('My Vacations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('newvacationtl')" :active="request()->routeIs('newvacationtl')">
                        {{ __('Request Vacation') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pendingvacationteam.index')" :active="request()->routeIs('pendingvacationteam.index')">
                        {{ __('Pending Employee Vacations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employeesonvacation.index')" :active="request()->routeIs('employeesonvacation.index')">
                        {{ __('Employees on Vacation') }}
                    </x-nav-link>
                    @endif
                    @if(Auth::user()->role == "project leader")
                    <x-nav-link :href="route('myproject.index')" :active="request()->routeIs('myproject.index')">
                        {{ __('My Project') }}
                    </x-nav-link>
                    <x-nav-link :href="route('myvacationspl.index')" :active="request()->routeIs('myvacationspl.index')">
                        {{ __('My Vacations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('newvacationpl')" :active="request()->routeIs('newvacationpl')">
                        {{ __('Request Vacation') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pendingvacationproject.index')" :active="request()->routeIs('pendingvacationproject.index')">
                        {{ __('Pending Employee Vacations') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('addemployee')" :active="request()->routeIs('addemployee')">
                {{ __('Add Employee') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
