<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    {{-- <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn"
        class="lg:hidden fixed top-5 left-5 z-50 w-11 h-11 flex items-center justify-center rounded-full bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 shadow-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-5 h-5 text-zinc-700 dark:text-zinc-300">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button> --}}

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay"
        class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-30 hidden transition-opacity duration-300"></div>

    <section id="content" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 z-40 w-[280px] flex flex-col h-screen bg-white dark:bg-zinc-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center" wire:navigate>
                    <x-app-logo />
                </a>
                <button id="close-sidebar"
                    class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 text-zinc-600 dark:text-zinc-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Content -->
            <div class="flex-1 overflow-y-auto px-4 py-6">
                <!-- Platform Menu -->
                <div class="mb-8">
                    <h3
                        class="px-3 mb-3 font-semibold text-[11px] uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                        Platform
                    </h3>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-green-600 text-white shadow-lg shadow-green-500/20' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                            wire:navigate>
                            <flux:icon.home variant="outline"
                                class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                            <span class="font-medium text-[15px]">{{ __('Dashboard') }}</span>
                        </a>

                        <a href="{{ route('documents.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-full transition-all duration-200 group {{ request()->routeIs('documents.index') ? 'bg-green-600 text-white shadow-lg shadow-green-500/20' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}"
                            wire:navigate>
                            <flux:icon.archive-box variant="outline"
                                class="w-5 h-5 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200' }}" />
                            <span class="font-medium text-[15px]">{{ __('Document') }}</span>
                        </a>
                    </nav>
                </div>
                <!-- Others Menu -->
                <div>
                    <h3
                        class="px-3 mb-3 font-semibold text-[11px] uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                        Others
                    </h3>
                    <nav class="space-y-1">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-full text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all duration-200 group"
                            wire:navigate>
                            <flux:icon.cog variant="outline"
                                class="w-5 h-5 text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200" />
                            <span class="font-medium text-[15px]">{{ __('Settings') }}</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-full text-zinc-700 dark:text-zinc-300 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 group">
                        <flux:icon.arrow-right-start-on-rectangle variant="outline"
                            class="w-5 h-5 text-zinc-500 dark:text-zinc-400 group-hover:text-red-600 dark:group-hover:text-red-400" />
                        <span class="font-medium text-[15px]">{{ __('Logout') }}</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div id="menu-content" class="flex flex-col flex-1 h-screen overflow-hidden bg-indigo-50/50 dark:bg-zinc-800 ">
            <!-- Top Navigation Bar -->
            <header class="sticky top-0 z-20 container mx-auto px-10">
                <div
                    class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 mt-4 container mx-auto">
                    <!-- Main Content Section -->
                    <div class="flex bg-white w-full justify-between items-center p-4 sm:p-5 rounded-3xl">
                        <h1 class="flex items-center text-zinc-700 dark:text-zinc-300 text-xl sm:text-2xl font-bold">
                            Overview
                        </h1>
                        <div class="flex">
                            <div class="flex items-center gap-2">
                                <a href="#"
                                    class="w-[40px] h-[40px] sm:w-[44px] sm:h-[44px] flex items-center justify-center rounded-full bg-zinc-100/70 dark:bg-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                    <svg viewBox="0 0 24 24"
                                        class="w-5 h-5 sm:w-6 sm:h-6 text-zinc-600 dark:text-zinc-400" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#"
                                    class="w-[40px] h-[40px] sm:w-[44px] sm:h-[44px] flex items-center justify-center rounded-full bg-zinc-100/70 dark:bg-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                    <svg viewBox="0 0 24 24"
                                        class="w-5 h-5 sm:w-6 sm:h-6 text-zinc-600 dark:text-zinc-400" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g clip-path="url(#a)" stroke="#000000" stroke-width="1.5"
                                                stroke-miterlimit="10">
                                                <path
                                                    d="M5 12H1M23 12h-4M7.05 7.05 4.222 4.222M19.778 19.778 16.95 16.95M7.05 16.95l-2.828 2.828M19.778 4.222 16.95 7.05"
                                                    stroke-linecap="round"></path>
                                                <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" fill="#000000"
                                                    fill-opacity=".16"></path>
                                                <path d="M12 19v4M12 1v4" stroke-linecap="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="a">
                                                    <path fill="#ffffff" d="M0 0h24v24H0z"></path>
                                                </clipPath>
                                            </defs>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Section -->
                    <div
                        class="flex bg-white justify-between w-full sm:w-[30%] items-center p-4 sm:p-5 rounded-3xl gap-3 sm:gap-4">
                        <div
                            class="w-10 h-10 flex-shrink-0 rounded-full overflow-hidden bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center ring-2 ring-zinc-200 dark:ring-zinc-700">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ Storage::url(auth()->user()->profile_photo) }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-sm font-bold">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </span>
                            @endif
                        </div>
                        <div class="flex-1 text-start min-w-0">
                            <p
                                class="text-sm sm:text-[16px] font-bold text-zinc-900 dark:text-zinc-100 leading-tight mb-1 truncate">
                                {{ \Illuminate\Support\Str::limit(auth()->user()->name, 25) }}
                            </p>
                            <p
                                class="text-xs sm:text-[14px] font-semibold text-zinc-500 dark:text-zinc-400 leading-tight">
                                Manager
                            </p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                            @csrf
                            <button type="submit"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-red-100/70 cursor-pointer dark:bg-red-800 hover:bg-red-100 dark:hover:bg-red-800 transition-colors">
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
            </header>

            <!-- Page Content -->
            <main class="overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </section>

    @fluxScripts

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebar = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarFunc() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openSidebar);
        if (closeSidebar) closeSidebar.addEventListener('click', closeSidebarFunc);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebarFunc);

        // Close sidebar when clicking a nav link on mobile
        const navLinks = sidebar.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarFunc();
                }
            });
        });

        // Handle escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                closeSidebarFunc();
            }
        });
    </script>
</body>

</html>
