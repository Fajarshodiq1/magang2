@php
    $base = 'px-6 py-2.5 rounded-full font-semibold text-sm flex items-center justify-center transition
         disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' =>
            'bg-emerald-600 hover:bg-emerald-700 text-white font-semibold dark:bg-white dark:text-zinc-900 dark:hover:bg-gray-100',
        'secondary' => 'border border-gray-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300
             hover:bg-gray-50 dark:hover:bg-zinc-700',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'outline' => 'border border-emerald-600 text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}
        @if ($loading) wire:loading.attr="disabled"
            wire:target="{{ $loading }}" @endif>
        @if ($loading)
            <span wire:loading.remove wire:target="{{ $loading }}" class="flex items-center">
                {{ $slot }}
            </span>
            <span wire:loading wire:target="{{ $loading }}" class="flex items-center">
                <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
