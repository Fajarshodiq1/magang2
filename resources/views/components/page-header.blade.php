@props([
    'title' => '',
    'subtitle' => '',
    'count' => null,
    'icon' => 'document',
    'iconColor' => 'emerald',
    'showMenu' => false,
    'menuView' => null,
])

@php
    // Icon mapping
    $icons = [
        'document' =>
            'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z',
        'user' =>
            'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z',
        'folder' =>
            'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z',
        'chart' =>
            'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z',
        'settings' =>
            'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    ];

    // Color mapping
    $colors = [
        'emerald' => 'from-emerald-500 to-emerald-600',
        'blue' => 'from-blue-500 to-blue-600',
        'purple' => 'from-purple-500 to-purple-600',
        'orange' => 'from-orange-500 to-orange-600',
        'red' => 'from-red-500 to-red-600',
        'green' => 'from-green-500 to-green-600',
        'indigo' => 'from-indigo-500 to-indigo-600',
        'pink' => 'from-pink-500 to-pink-600',
    ];

    $iconPath = $icons[$icon] ?? $icons['document'];
    $gradientColor = $colors[$iconColor] ?? $colors['emerald'];
@endphp

<div class="mb-6 sm:mb-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        {{-- Left Section: Icon + Title --}}
        <div class="flex items-start sm:items-center gap-3 sm:gap-4">
            {{-- Icon --}}
            <div
                class="flex-shrink-0 p-2.5 sm:p-3 bg-gradient-to-br {{ $gradientColor }} rounded-xl sm:rounded-2xl shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}" />
                </svg>
            </div>

            {{-- Title & Subtitle --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
                    @if ($count !== null)
                        <span class="block sm:inline">{{ $count }}</span>
                        <span class="block sm:inline sm:ml-1">{{ $title }}</span>
                    @else
                        {{ $title }}
                    @endif
                </h1>
                @if ($subtitle)
                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mt-0.5 sm:mt-1 font-medium">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Right Section: Menu/Actions --}}
        @if ($showMenu && $menuView)
            <div class="flex-shrink-0">
                @include($menuView)
            </div>
        @endif

        {{-- Slot for custom actions --}}
        @if ($slot->isNotEmpty())
            <div class="flex-shrink-0">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
