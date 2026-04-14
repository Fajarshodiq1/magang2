@php
    $base = 'p-2 rounded-lg transition flex items-center justify-center';

    $variants = [
        'preview' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400
                      hover:bg-indigo-200 dark:hover:bg-indigo-900/50',
        'edit' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                   hover:bg-blue-200 dark:hover:bg-blue-900/50',
        'delete' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400
                     hover:bg-red-200 dark:hover:bg-red-900/50',
        'default' => 'bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-gray-300
                      hover:bg-gray-200 dark:hover:bg-zinc-700',
    ];

    $icons = [
        'eye' => '
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5
                       c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639
                       C20.577 16.49 16.64 19.5 12 19.5
                       c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        ',
        'pencil' => '
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652
                       L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685
                       a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
            </svg>
        ',
        'trash' => '
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9
                       m9.968-3.21L18.16 19.673
                       a2.25 2.25 0 01-2.244 2.077
                       H8.084a2.25 2.25 0 01-2.244-2.077
                       L4.772 5.79"/>
            </svg>
        ',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }} title="{{ $attributes->get('title') }}">
        {!! $icons[$icon] ?? '' !!}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }} title="{{ $attributes->get('title') }}">
        {!! $icons[$icon] ?? '' !!}
    </button>
@endif
