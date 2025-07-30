<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-600">
                            <i class="text-sm text-white fas fa-blog"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">BlogHub</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:items-center sm:ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-gray-700 transition-colors duration-200 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                        <i class="mr-2 fas fa-home"></i>{{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('blog-posts.index') }}" :active="request()->routeIs('blog-posts.*')"
                        class="text-gray-700 transition-colors duration-200 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                        <i class="mr-2 fas fa-newspaper"></i>{{ __('Blog Posts') }}
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
                        <x-nav-link href="{{ route('blog-posts.create') }}" :active="request()->routeIs('blog-posts.create')"
                            class="text-gray-700 transition-colors duration-200 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <i class="mr-2 fas fa-plus"></i>{{ __('New Post') }}
                        </x-nav-link>
                        @endif

                        @if(auth()->user()->hasRole('admin'))
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.*')"
                            class="text-gray-700 transition-colors duration-200 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <i class="mr-2 fas fa-cog"></i>{{ __('Admin') }}
                        </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-4 sm:flex sm:items-center sm:ml-6">
                <!-- Dark Mode Toggle -->
                <button onclick="toggleDarkMode()"
                    class="p-2 text-gray-500 transition-colors duration-200 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="hidden fas fa-sun dark:block"></i>
                </button>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 transition-colors duration-200 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900">
                                    <span class="text-sm font-semibold text-primary-600 dark:text-primary-400">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="text-xs fas fa-chevron-down"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <i class="mr-2 fas fa-user"></i>{{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="{{ route('bookmarks.index') }}" class="flex items-center">
                            <i class="mr-2 fas fa-bookmark"></i>{{ __('Saved Posts') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                                <i class="mr-2 fas fa-sign-out-alt"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                <i class="mr-3 fas fa-home"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('blog-posts.index') }}" :active="request()->routeIs('blog-posts.*')"
                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                <i class="mr-3 fas fa-newspaper"></i>{{ __('Blog Posts') }}
            </x-responsive-nav-link>

            @auth
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor'))
                <x-responsive-nav-link href="{{ route('blog-posts.create') }}" :active="request()->routeIs('blog-posts.create')"
                    class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <i class="mr-3 fas fa-plus"></i>{{ __('New Post') }}
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->hasRole('admin'))
                <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.*')"
                    class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <i class="mr-3 fas fa-cog"></i>{{ __('Admin') }}
                </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-800">
            <div class="px-4 py-3">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900">
                        <span class="font-semibold text-primary-600 dark:text-primary-400">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <div class="text-base font-medium text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-4 py-2">
                    <i class="mr-3 fas fa-user"></i>{{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('bookmarks.index') }}" class="flex items-center px-4 py-2">
                    <i class="mr-3 fas fa-bookmark"></i>{{ __('Saved Posts') }}
                </x-responsive-nav-link>

                <!-- Dark Mode Toggle Mobile -->
                <button onclick="toggleDarkMode()"
                    class="flex items-center w-full px-4 py-2 text-left text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <i class="mr-3 fas fa-moon dark:hidden"></i>
                    <i class="hidden mr-3 fas fa-sun dark:block"></i>{{ __('Toggle Dark Mode') }}
                </button>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center px-4 py-2 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                        <i class="mr-3 fas fa-sign-out-alt"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
