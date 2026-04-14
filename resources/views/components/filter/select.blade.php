@props(['label', 'model', 'icon' => null])

<div
    class="inline-flex items-center gap-2 h-10 px-3 rounded-lg border border-zinc-300 dark:border-zinc-700
            bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors">
    @if ($icon)
        <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            {!! $icon !!}
        </svg>
    @endif
    <span class="text-zinc-600 dark:text-zinc-400 text-xs font-medium whitespace-nowrap">{{ $label }}:</span>
    <select wire:model.live="{{ $model }}"
        class="bg-transparent border-none text-sm text-zinc-900 dark:text-white font-medium
                   focus:ring-0 focus:outline-none cursor-pointer pr-8 -mr-6 appearance-none">
        {{ $slot }}
    </select>
    <svg class="w-4 h-4 text-zinc-400 pointer-events-none ml-auto" fill="none" stroke="currentColor"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
</div>
