<nav x-data="{ open: false }"
     class="bg-white sticky top-0 z-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="navbar sticky top-0 z-50 bg-base-100 px-6">
        <div class="navbar-start">
            <!-- Hamburger -->
            <div class="drawer-content lg:w-full">
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
                <label for="my-drawer" class="btn btn-circle btn-ghost drawer-button lg:hidden"
                       x-data="{ open: false }">
                    <i class="fas text-[20px]" :class="{ 'fa-times': open, 'fa-bars': !open }"
                       @click="open = !open"></i>
                </label>

            </div>
            <!--Hamburger -->
        </div>
        <div class="navbar-center">
            <p class="normal-case font-bold text-2xl">Chuka Uni</p>
            {{--            <a href="{{ route('dashboard') }}">--}}
            {{--                <img src="{{ asset('images/logo.png') }}" alt="Chuka Uni" class="w-28 sm:w-32">--}}
            {{--            </a>--}}
        </div>
        <div class="navbar-end items-center">

            <!--Search-->
            <div class="hidden mx-2 lg:flex lg:items-center">
                <div class="relative text-gray-500">
                    <input type="search" name="search" placeholder="Search"
                           class="h-10 bg-base-300 px-5 pr-10 rounded-full text-sm focus:outline-none">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mx-4">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            @auth
                <!-- Notifications -->
                <a data-tip="Notifications" class="indicator tooltip tooltip-bottom"
                   href="{{ route('notifications.user') }}">
                    <span
                        class="indicator-item bg-orange-500 flex items-center justify-center text-gray-50 w-[15px] h-[15px] border text-xs px-1 rounded-full">
                        <!-- Get the total count of unread notifications -->
                        {{ Auth::user()->unreadNotificationCount() ?? '9' }}
                    </span>
                    <section class="btn ring btn-sm btn-circle">
                        <i class="fa-solid fa-bell"></i>
                    </section>
                </a>
            @endauth

            <div class="hidden sm:flex sm:items-center">

                <!-- Settings Dropdown -->
                <div class="hidden mx-1 sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <div data-tip="{{ Auth::user()->name ?? 'Guest' }}"
                                 class="transition tooltip tooltip-bottom text-xl btn p-0 btn-ghost btn-circle flex ease-in-out duration-150">
                                <div class="avatar">
                                    <div class="w-8 rounded-full ring-1 ring-offset-base-100 ring-offset-2">
                                        <img
                                            src="{{ asset('storage/user_images/QvuwNTVS6Webd005YeZW9Ek4kxM8IlqGXGDpuN48.jpg') }}"
                                            alt="{{ Auth::user()->name ?? null }}"/>
                                    </div>
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

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

                {{--                <section class="btn mx-1 btn-ghost btn-circle">--}}
                {{--                    <div class="indicator">--}}

                {{--                        <i class="text-2xl fa-solid fa-circle-user"></i>--}}

                {{--                        <!-- if the user status is active -->--}}
                {{--                        @if(Auth()->user()->status == 'active')--}}
                {{--                            <span class="badge badge-xs badge-success indicator-item"></span>--}}
                {{--                        @else--}}
                {{--                            <span class="badge badge-xs bg-red-600 indicator-item"></span>--}}
                {{--                        @endif--}}

                {{--                    </div>--}}
                {{--                </section>--}}
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
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
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div
                    class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name ?? 'Guest' }}</div>
                <div
                    class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'loggedout@tests.com' }}</div>
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

