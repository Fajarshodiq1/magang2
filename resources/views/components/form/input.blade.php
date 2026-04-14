@props([
    'label' => null,
    'model' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'isParent' => false,
    'hasChildren' => false, // ✅ Tambahan untuk edit mode
    'currentBalance' => 0, // ✅ Untuk tampilkan balance saat ini
    'childrenCount' => 0, // ✅ Jumlah children
    'prefix' => null,
    'step' => null,
    'min' => null,
    'helperText' => null,
    'parentHelperText' => 'Saldo parent akan otomatis terhitung dari total children', // ✅ Customizable
])

<div class="space-y-2">

    {{-- Label --}}
    @if ($label)
        <label class="block text-sm font-semibold text-[#0A090B] dark:text-white">

            {{ $label }}

            {{-- Parent note --}}
            @if ($isParent || $hasChildren)
                <span class="text-[#7F8190] dark:text-zinc-500 text-xs font-normal">
                    (Auto-calculated dari children)
                </span>
            @else
                {{-- Required / Optional --}}
                @if ($required)
                    <span class="text-red-500">*</span>
                @else
                    <span class="text-[#7F8190] dark:text-zinc-500 text-xs font-normal">(Opsional)</span>
                @endif
            @endif

        </label>
    @endif


    <div class="relative">

        {{-- PREFIX (Rp) --}}
        @if ($prefix)
            <div class="absolute left-0 h-full pl-4 flex items-center pointer-events-none">
                <span class="text-[#7F8190] dark:text-zinc-500 font-semibold">
                    {{ $prefix }}
                </span>
            </div>
        @endif

        {{-- ICON --}}
        @isset($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {{ $icon }}
            </div>
        @endisset


        {{-- INPUT FIELD --}}
        @if ($isParent || $hasChildren)
            {{-- Parent: Disabled dengan current balance --}}
            <input type="text" value="{{ number_format($currentBalance, 0, ',', '.') }}" disabled
                class="w-full h-[52px] {{ $prefix || isset($icon) ? 'pl-10' : 'pl-4' }} pr-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-gray-100 dark:bg-zinc-900 text-[#7F8190] dark:text-zinc-500 font-semibold cursor-not-allowed">
        @else
            {{-- Children: Input normal --}}
            <input type="{{ $type }}" wire:model="{{ $model }}" placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }} {{ $step ? "step={$step}" : '' }}
                {{ $min !== null ? "min={$min}" : '' }}
                class="w-full h-[52px] {{ $prefix || isset($icon) ? 'pl-10' : 'pl-4' }}  pr-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-900 text-[#0A090B] dark:text-white font-semibold placeholder:text-[#7F8190] placeholder:font-semibold text-[14px] outline-none focus:border-indigo focus:ring-2 focus:ring-indigo-500 dark:focus:ring-white transition-all">
        @endif
    </div>


    {{-- Parent helper text --}}
    @if ($isParent || $hasChildren)
        <p class="text-xs text-[#2B82FE] mt-2 flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
            </svg>
            @if ($hasChildren && $childrenCount > 0)
                Saldo terhitung dari {{ $childrenCount }} sub-akun
            @else
                {{ $parentHelperText }}
            @endif
        </p>
    @endif


    {{-- Validation Error atau Helper Text untuk children --}}
    @if (!$isParent && !$hasChildren)
        @error($model)
            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
        @else
            @if ($helperText)
                <p class="text-xs text-[#7F8190] dark:text-zinc-500 mt-2">
                    {{ $helperText }}
                </p>
            @endif
        @enderror
    @endif

</div>
