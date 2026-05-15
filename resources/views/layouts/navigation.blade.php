<nav x-data="{ open: false }" class="bg-[#080808] border-b border-zinc-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="h-8 w-8 bg-[#d4af37] flex items-center justify-center rounded-lg shadow-[0_0_15px_rgba(212,175,85,0.3)]">
                             <span class="text-black font-black text-xl">V</span>
                        </div>
                        <span class="text-white font-black tracking-tighter text-xl">VOIDX</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-400 hover:text-[#d4af37] transition-colors">
                        Dashboard
                    </x-nav-link>

                    @if(in_array(auth()->user()->role, ['admin', 'high_admin', 'owner']))
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-[#d4af37] font-bold border-[#d4af37]">
                        Admin Panel
                    </x-nav-link>
                    @endif

                    @if(Route::has('posts.index'))
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-zinc-400 hover:text-[#d4af37]">
                        Posts
                    </x-nav-link>
                    @endif
                </div>
            </div>

            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-300 bg-zinc-900/50 border border-zinc-800 rounded-xl hover:text-[#d4af37] hover:border-[#d4af37]/50 focus:outline-none transition-all duration-300">
                            <div class="flex flex-col items-end mr-2">
                                <span class="text-[9px] uppercase tracking-widest text-zinc-500 font-bold leading-none mb-1">{{ auth()->user()->role }}</span>
                                <span class="leading-none">{{ auth()->user()->name }}</span>
                            </div>

                            <svg class="h-4 w-4 fill-current text-zinc-500" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-zinc-900 border border-zinc-800 rounded-lg overflow-hidden shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="text-zinc-300 hover:bg-[#d4af37] hover:text-black transition-colors">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-zinc-500 hover:bg-red-600 hover:text-white transition-colors">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-500 hover:text-[#d4af37] hover:bg-zinc-900 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden bg-[#0a0a0a] border-t border-zinc-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-400">
                Dashboard
            </x-responsive-nav-link>

            @if(in_array(auth()->user()->role, ['admin', 'high_admin', 'owner']))
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-[#d4af37] font-bold">
                Admin Panel
            </x-responsive-nav-link>
            @endif

            @if(Route::has('posts.index'))
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-zinc-400">
                Posts
            </x-responsive-nav-link>
            @endif
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-zinc-800">
            <div class="px-4">
                <div class="font-medium text-base text-zinc-200">{{ auth()->user()->name }}</div>
                <div class="font-medium text-sm text-zinc-500">{{ auth()->user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-zinc-400">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500 font-bold">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>