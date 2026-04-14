@props([
    'label' => null,
    'model' => null,
    'placeholder' => '',
    'required' => false,
    'helperText' => null,
])

<div x-data="{ show: false }" class="space-y-2">
    {{-- Label --}}
    @if ($label)
        <label class="block text-sm font-semibold text-[#0A090B] dark:text-white">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-[#7F8190] dark:text-zinc-500 text-xs font-normal">(Opsional)</span>
            @endif
        </label>
    @endif

    <div class="relative">
        {{-- Input --}}
        <input :type="show ? 'text' : 'password'" wire:model="{{ $model }}" placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            class="w-full h-[52px] pl-4 pr-12 rounded-full
                border border-[#EEEEEE] dark:border-zinc-700
                bg-white dark:bg-zinc-900
                text-[#0A090B] dark:text-white font-semibold
                placeholder:text-[#7F8190] placeholder:font-semibold
                text-[14px] outline-none
                focus:border-indigo focus:ring-2 focus:ring-indigo-500
                dark:focus:ring-white transition-all">

        {{-- Toggle Button --}}
        <button type="button" @click="show = !show"
            class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#7F8190] hover:text-indigo-500">
            <template x-if="!show">
                {{-- Eye --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                           c4.478 0 8.268 2.943 9.542 7
                           -1.274 4.057-5.064 7-9.542 7
                           -4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </template>

            <template x-if="show">
                {{-- Eye Off --}}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                           c-4.478 0-8.268-2.943-9.542-7
                           a9.956 9.956 0 012.223-3.592M6.223 6.223
                           A9.956 9.956 0 0112 5
                           c4.478 0 8.268 2.943 9.542 7
                           a9.973 9.973 0 01-4.132 5.411M15 12
                           a3 3 0 00-4.243-4.243M9.88 9.88
                           a3 3 0 004.243 4.243M3 3l18 18" />
                </svg>
            </template>
        </button>
    </div>

    {{-- Error / Helper --}}
    @error($model)
        <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
            {{ $message }}
        </p>
    @else
        @if ($helperText)
            <p class="text-xs text-[#7F8190] dark:text-zinc-500 mt-2">
                {{ $helperText }}
            </p>
        @endif
    @enderror
</div>
