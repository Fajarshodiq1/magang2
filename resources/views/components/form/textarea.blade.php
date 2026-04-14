<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
        {{ $label }}
        @if ($required)
            <span class="text-red-500 dark:text-red-400">*</span>
        @endif
    </label>

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' =>
                'w-full min-h-[120px] pl-4 pr-4 py-4 rounded-3xl border border-[#EEEEEE] dark:border-zinc-700
                                    bg-white dark:bg-zinc-900 text-[#0A090B] dark:text-white font-semibold
                                    placeholder:text-[#7F8190] placeholder:font-semibold text-[14px]
                                    outline-none resize-none transition-all
                                    focus:border-emerald-500 focus:ring focus:ring-emerald-500 dark:focus:ring-white ' .
                ($errors->has($name) ? 'border-red-500 ring-2 ring-red-200 dark:ring-red-900/50' : ''),
        ]) }}></textarea>

</div>
