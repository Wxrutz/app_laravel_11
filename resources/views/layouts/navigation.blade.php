<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <img src="https://www.bru.ac.th/wp-content/uploads/2018/09/LOGO-bru-227x300.png" alt="" class="h-14 w-10 justify-content items-center ">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('dashboard')" :active="Auth::user()->usertype == 'admin'
                        ? request()->routeIs('admin.dashboard')
                        : request()->routeIs('dashboard')" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- admin --}}
                    @if (Auth::user()->usertype == 'admin')
                        <x-nav-link href="{{ url('admin/users') }}" :active="request()->routeIs('admin.users')" class="no-underline text-yellow-500 hover:text-yellow-300">
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('admin/courses') }}" :active="request()->routeIs('admin.courses')" class="no-underline text-yellow-500 hover:text-yellow-300">
                            {{ __('Courses') }}
                        </x-nav-link>
                    @endif


                    {{-- users --}}
                    @if (Auth::user()->usertype == 'user')
                        <x-nav-link href="{{ url('courses') }}" :active="request()->routeIs('courses')" class="no-underline text-yellow-500 hover:text-yellow-300">
                            {{ __('Courses') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('profile') }}" :active="request()->routeIs('profile.edit')" class="no-underline text-yellow-500 hover:text-yellow-300">
                            {{ __('Profile') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-yellow-500 bg-gray-800 hover:text-yellow-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link> --}}

                        {{-- admin --}}
                        @if (Auth::user()->usertype == 'admin')
                            <x-dropdown-link href="courses" :active="request()->routeIs('admin.courses')" class="no-underline text-yellow-500 hover:text-yellow-300">
                                {{ __('Courses') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="users" :active="request()->routeIs('admin.users')" class="no-underline text-yellow-500 hover:text-yellow-300">
                                {{ __('Users') }}
                            </x-dropdown-link>
                        @endif

                        {{-- users --}}
                        @if (Auth::user()->usertype == 'user')
                            <x-dropdown-link href="courses" :active="request()->routeIs('user.courses')" class="no-underline text-yellow-500 hover:text-yellow-300">
                                {{ __('Courses') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="profile" :active="request()->routeIs('profile.edit')" class="no-underline text-yellow-500 hover:text-yellow-300">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();" class="no-underline text-yellow-500 hover:text-yellow-300">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-yellow-300 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-yellow-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="no-underline text-yellow-500 hover:text-yellow-300">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-yellow-500">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-yellow-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- admin --}}
                @if (Auth::user()->usertype == 'admin')
                    <x-responsive-nav-link href="lessons" :active="request()->routeIs('admin.lessons')" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Lessons') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="users" :active="request()->routeIs('admin.users')" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Users') }}
                    </x-responsive-nav-link>
                @endif

                {{-- users --}}
                @if (Auth::user()->usertype == 'user')
                    <x-responsive-nav-link href="lessons" :active="request()->routeIs('user.lessons')" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Lessons') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="profile" :active="request()->routeIs('profile.edit')" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();" class="no-underline text-yellow-500 hover:text-yellow-300">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
