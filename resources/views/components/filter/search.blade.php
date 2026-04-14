@props([
    'label' => 'Pencarian',
    'model',
    'placeholder' => 'Cari...',
])

<div class="flex-1 min-w-[200px]">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <input type="text" wire:model.live.debounce.300ms="{{ $model }}" placeholder="{{ $placeholder }}"
            class="w-full h-10 pl-9 pr-4 rounded-lg border border-zinc-300 dark:border-zinc-700
                   bg-white dark:bg-zinc-800 text-sm text-zinc-900 dark:text-white
                   placeholder:text-zinc-400 dark:placeholder:text-zinc-500
                   focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 
                   transition-all outline-none">
    </div>
</div>
