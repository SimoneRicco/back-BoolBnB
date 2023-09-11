<nav x-data="{ open: false }" class="bg-red-100 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-end mt-3">
                    <a href="http://localhost:5173/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.apartments.index')" :active="request()->routeIs('apartments')">
                        {{ __('Apartments') }}
                    </x-nav-link>
                
                    <x-nav-link :href="route('admin.apartments.trashed')" :active="request()->routeIs('Bin')">
                        {{ __('Bin') }}
                    </x-nav-link>
                
                    <x-nav-link :href="route('admin.apartments.create')" :active="request()->routeIs('New Apartment')">
                        {{ __('New Apartment') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.apartments.receives')" :active="request()->routeIs('Your Receives')">
                        {{ __('Your Receives') }}
                    </x-nav-link>
                    {{-- <x-nav-link href="http://localhost:5173/">
                        {{ __('To Front') }}
                    </x-nav-link> --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="flex align-middle">
                            <button class="inline-flex items-center px-3 py-[-25px] border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-10 h-10 rounded-full" src="{{ asset('storage/uploads/' . Auth::user()->image) }}" alt="{{ Auth::user()->id }}">
                                </button>
                            </button>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3">
                            <div class="flex">
                                <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->lastname }}</span>
                            </div>
                            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('login')"
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden sm:flex flex-col">
        <div class="p-4 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-nav-link :href="route('admin.apartments.index')" :active="request()->routeIs('apartments')">
                {{ __('Apartments') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.apartments.trashed')" :active="request()->routeIs('Bin')">
                {{ __('Bin') }}
            </x-nav-link>
        
            <x-nav-link :href="route('admin.apartments.create')" :active="request()->routeIs('New Apartment')">
                {{ __('New Apartment') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.apartments.receives')" :active="request()->routeIs('Your Receives')">
                {{ __('Your Receives') }}
            </x-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

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
