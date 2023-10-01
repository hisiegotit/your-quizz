<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->routeIs('/')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>


            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link name="trigger">

                    <div>{{ Auth::user()->name }}</div>

                </x-nav-link>

                <x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>