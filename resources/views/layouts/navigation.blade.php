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

            <!-- Dark Mode Switch -->

            <label class="swap swap-rotate mx-3">
                <!-- this hidden checkbox controls the state -->
                <input class="hidden" id="theme-switch" type="checkbox"/>

                <!-- sun icon -->
                <svg class="swap-on fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
                </svg>

                <!-- moon icon -->
                <svg class="swap-off fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/>
                </svg>
            </label>


            @auth
                <!-- Notifications -->
                <a class="indicator" href="{{ route('notifications.user') }}">
                    <span
                        class="indicator-item bg-orange-500 flex items-center justify-center text-gray-50 w-[15px] h-[15px] border text-xs px-1 rounded-full">
                        <!-- Get the total count of unread notifications -->
                        {{ Auth::user()->unreadNotificationCount() }}
                    </span>
                    <section class="btn btn-sm btn-circle">
                        <i class="fa-solid fa-bell"></i>
                    </section>
                </a>
            @endauth

            <div class="hidden sm:flex sm:items-center">

                <!-- Settings Dropdown -->
                <div class="hidden mx-1 sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <div title="{{ Auth::user()->name ?? 'Guest' }}"
                                 class="transition text-xl btn p-0 btn-ghost btn-circle flex ease-in-out duration-150">
                                <i class="fa-solid fa-spin fa-gear"></i>
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
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
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
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'loggedout@tests.com' }}</div>
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

