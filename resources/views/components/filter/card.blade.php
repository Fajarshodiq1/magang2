@props([
    'title' => 'Filter & Pencarian',
])

<div
    {{ $attributes->merge([
        'class' =>
            'bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden transition-colors duration-200',
    ]) }}>
    <!-- Compact Filter Bar -->
    <div class="p-4">
        <div class="flex flex-wrap items-center gap-3">
            {{ $slot }}
        </div>
    </div>
</div>
