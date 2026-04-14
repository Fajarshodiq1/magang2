<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
        @if ($required)
            <span class="text-red-500 dark:text-red-400">*</span>
        @endif
    </label>

    <div class="relative">
        @if ($icon ?? false)
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <div class="text-gray-400 dark:text-gray-500">
                    {{ $icon }}
                </div>
            </div>
        @endif

        <select id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge([
                'class' =>
                    'w-full py-3.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 font-semibold
                                                                    text-gray-900 text-sm dark:text-white rounded-full appearance-none
                                                                    focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent
                                                                    dark:focus:ring-emerald-600 transition-all duration-200 ' .
                    (isset($icon) ? 'pl-11 pr-11' : 'px-4 pr-11') .
                    ' ' .
                    ($errors->has($name) ? 'border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-900/50' : ''),
            ]) }}>
            @if ($placeholder ?? false)
                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">
                    {{ $placeholder }}
                </option>
            @endif
            {{ $slot }}
        </select>

        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
        </p>
    @enderror
</div>
