<nav x-data="{ open: false }" class="px-4 pt-5 sm:px-6 lg:px-8">
    <!-- Primary Navigation Menu -->
    <div class="glass-panel max-w-7xl mx-auto rounded-[2rem] px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-[82px] justify-between gap-4">
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="rounded-2xl bg-gradient-to-br from-red-50 via-white to-slate-100 p-2 shadow-inner">
                            <x-application-logo class="block h-11 w-auto" />
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-red-700">Kosku</p>
                            <p class="text-sm font-medium text-slate-500">Sistem Manajemen Kos</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden flex-wrap items-center gap-2 sm:ms-4 sm:flex">

                    @if(auth()->user()->role === 'pemilik')
                        <x-nav-link :href="route('pemilik.dashboard')" :active="request()->routeIs('pemilik.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.room-types.index')" :active="request()->routeIs('pemilik.room-types.*')">
                            {{ __('Tipe Kamar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.rooms.index')" :active="request()->routeIs('pemilik.rooms.*')">
                            {{ __('Kamar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.tenants.index')" :active="request()->routeIs('pemilik.tenants.*')">
                            {{ __('Penyewa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.contracts.index')" :active="request()->routeIs('pemilik.contracts.*')">
                            {{ __('Kontrak') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.bills.index')" :active="request()->routeIs('pemilik.bills.*')">
                            {{ __('Tagihan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.payments.index')" :active="request()->routeIs('pemilik.payments.*')">
                         {{ __('Konfirmasi Bayar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pemilik.reports.index')" :active="request()->routeIs('pemilik.reports.*')">
                            {{ __('Laporan') }}
                        </x-nav-link>

                    @elseif(auth()->user()->role === 'penyewa')
                        <x-nav-link :href="route('penyewa.dashboard')" :active="request()->routeIs('penyewa.dashboard.*')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('penyewa.bills.index')" :active="request()->routeIs('penyewa.bills.*')">
                            {{ __('Tagihan Saya') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-2xl border border-red-100 bg-gradient-to-r from-white to-red-50 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition duration-150 hover:border-red-200 hover:text-red-700 focus:outline-none">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="text-xs font-medium text-slate-500">{{ Auth::user()->role }}</div>
                            </div>

                            <div class="ms-1 text-slate-400">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Route::has('profile.edit'))
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

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
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-2.5 text-slate-500 transition duration-150 hover:border-red-200 hover:bg-red-50 hover:text-red-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-slate-200/70 sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->role === 'pemilik')
                <x-responsive-nav-link :href="route('pemilik.dashboard')" :active="request()->routeIs('pemilik.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.room-types.index')" :active="request()->routeIs('pemilik.room-types.*')">
                    {{ __('Tipe Kamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.rooms.index')" :active="request()->routeIs('pemilik.rooms.*')">
                    {{ __('Kamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.tenants.index')" :active="request()->routeIs('pemilik.tenants.*')">
                    {{ __('Penyewa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.contracts.index')" :active="request()->routeIs('pemilik.contracts.*')">
                    {{ __('Kontrak') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.bills.index')" :active="request()->routeIs('pemilik.bills.*')">
                    {{ __('Tagihan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.payments.index')" :active="request()->routeIs('pemilik.payments.*')">
                    {{ __('Konfirmasi Bayar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pemilik.reports.index')" :active="request()->routeIs('pemilik.reports.*')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
            @elseif(auth()->user()->role === 'penyewa')
                <x-responsive-nav-link :href="route('penyewa.dashboard')" :active="request()->routeIs('penyewa.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('penyewa.bills.index')" :active="request()->routeIs('penyewa.bills.*')">
                    {{ __('Tagihan Saya') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-slate-200/70">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if (Route::has('profile.edit'))
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

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
