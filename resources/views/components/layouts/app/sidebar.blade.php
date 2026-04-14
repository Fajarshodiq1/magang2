<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay"
        class="lg:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-40 opacity-0 invisible transition-all duration-300"
        aria-hidden="true"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 flex flex-col h-full bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 dark:border-zinc-800">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded-lg"
                    wire:navigate aria-label="Dashboard">
                    <x-app-logo />
                </a>
                <button id="close-sidebar" type="button"
                    class="lg:hidden p-2 rounded-lg text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-800 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    aria-label="Close sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Content -->
            <nav
                class="flex-1 overflow-y-auto px-4 py-6 scrollbar-thin scrollbar-thumb-zinc-300 dark:scrollbar-thumb-zinc-700 scrollbar-track-transparent">
                <!-- Platform Section -->
                <div class="mb-8">
                    <h3
                        class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Platform
                    </h3>
                    <ul class="space-y-1" role="list">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                                wire:navigate aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
                                <flux:icon.home variant="outline"
                                    class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                                <span class="font-medium text-sm">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                        @can('users.view')
                            <li>
                                <a href="{{ route('users.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('users.index') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                                    wire:navigate aria-current="{{ request()->routeIs('users.index') ? 'page' : 'false' }}">
                                    <flux:icon.user-plus variant="outline"
                                        class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('users.index') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                                    <span class="font-medium text-sm">{{ __('User Management') }}</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('documents.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('documents.index') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                                wire:navigate
                                aria-current="{{ request()->routeIs('documents.index') ? 'page' : 'false' }}">
                                <flux:icon.archive-box variant="outline"
                                    class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                                <span class="font-medium text-sm">{{ __('Document') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('categories.index') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                                wire:navigate
                                aria-current="{{ request()->routeIs('categories.index') ? 'page' : 'false' }}">
                                <flux:icon.archive-box variant="outline"
                                    class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('categories.index') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                                <span class="font-medium text-sm">{{ __('Category') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('archive-classifications.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('archive-classifications.index') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                                wire:navigate
                                aria-current="{{ request()->routeIs('archive-classifications.index') ? 'page' : 'false' }}">
                                <flux:icon.archive-box variant="outline"
                                    class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('archive-classifications.index') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                                <span class="font-medium text-sm">{{ __('Kode Klasifikasi') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Others Section -->
                <div>
                    <h3
                        class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Others
                    </h3>
                    <ul class="space-y-1" role="list">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800"
                                wire:navigate>
                                <flux:icon.cog variant="outline"
                                    class="w-5 h-5 flex-shrink-0 text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200" />
                                <span class="font-medium text-sm">{{ __('Settings') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-full text-zinc-700 dark:text-zinc-300 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 group focus:outline-none focus:ring-2 focus:ring-red-500">
                        <flux:icon.arrow-right-start-on-rectangle variant="outline"
                            class="w-5 h-5 flex-shrink-0 text-zinc-500 dark:text-zinc-400 group-hover:text-red-600 dark:group-hover:text-red-400" />
                        <span class="font-medium text-sm">{{ __('Logout') }}</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 w-full min-w-0 overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="sticky top-0 z-30 bg-zinc-50 dark:bg-zinc-900">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Main Header Card -->
                        <div
                            class="flex-1 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-2xl p-4 sm:p-5">
                            <div class="flex items-center justify-between gap-4">
                                <!-- Mobile Menu Button -->
                                <div class="flex items-center gap-4">
                                    <button id="mobile-menu-btn" type="button"
                                        class="lg:hidden p-2 rounded-lg text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-700 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        aria-label="Open sidebar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                    </button>

                                    <h1 class="text-xl sm:text-2xl font-bold text-zinc-800 dark:text-zinc-100">
                                        Overview
                                    </h1>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2">
                                    <button type="button"
                                        class="p-2 sm:p-2.5 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        aria-label="Search">
                                        <svg viewBox="0 0 24 24" class="w-5 h-5 text-zinc-600 dark:text-zinc-300"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon"
                                        variant="subtle" aria-label="Toggle dark mode" />
                                </div>
                            </div>
                        </div>

                        <!-- Profile Card -->
                        <div
                            class="lg:w-80 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-3xl p-4 hidden sm:flex">
                            <div class="flex items-center gap-3 w-full">
                                <!-- Avatar -->
                                <div class="relative flex-shrink-0">
                                    <div
                                        class="w-11 h-11 rounded-full overflow-hidden bg-emerald-600 flex items-center justify-center ring-2 ring-zinc-200 dark:ring-zinc-700">
                                        <span class="text-white text-sm font-bold">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <span
                                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-zinc-800 rounded-full"></span>
                                </div>

                                <!-- User Info -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 truncate">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="p-2 rounded-full bg-red-50 dark:bg-red-950/50 hover:bg-red-100 dark:hover:bg-red-950/70 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"
                                        aria-label="Logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-5 h-5 text-red-600 dark:text-red-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div>
                    {{ $slot }}
                </div>

                <div class="mt-20"></div>
            </main>
        </div>
    </div>

    @fluxScripts

    <script>
        // Sidebar Management
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const openBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar?.classList.remove('-translate-x-full');
            overlay?.classList.remove('invisible', 'opacity-0');
            overlay?.classList.add('visible', 'opacity-100');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar?.classList.add('-translate-x-full');
            overlay?.classList.remove('visible', 'opacity-100');
            overlay?.classList.add('invisible', 'opacity-0');
            document.body.style.overflow = '';
        }

        // Event Listeners
        openBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Close sidebar on navigation (mobile)
        sidebar?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) closeSidebar();
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        // Cleanup on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
    </script>
</body>

</html>
