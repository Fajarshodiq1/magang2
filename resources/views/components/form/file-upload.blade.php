@props([
    'file' => null,
    'model' => 'file',
    'label' => 'Upload File',
    'accept' => '',
    'maxSize' => '10MB',
    'required' => false,
])

@php
    $isImage = false;
    $extension = '';
    $fileName = '';
    $fileSize = 0;

    if ($file) {
        if (is_object($file)) {
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
        } else {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $fileName = basename($file);
        }
        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }
@endphp

<div class="mb-6">
    <label for="{{ $model }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="relative">
        <input type="file" id="{{ $model }}" wire:model="{{ $model }}" accept="{{ $accept }}"
            class="hidden">

        {{-- EMPTY STATE --}}
        @if (!$file)
            <label for="{{ $model }}"
                class="block border-2 border-dashed rounded-lg p-8 text-center cursor-pointer
                          border-gray-300 dark:border-gray-600 
                          bg-gray-50 dark:bg-gray-800/50
                          hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/10
                          @error($model) border-red-300 bg-red-50 dark:border-red-700 dark:bg-red-900/10 @enderror">

                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>

                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Klik untuk upload atau drag & drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $accept ?: 'Semua file' }} (Max: {{ $maxSize }})
                </p>
            </label>
        @endif

        {{-- FILE SELECTED --}}
        @if ($file)
            <div class="border-2 border-green-500 dark:border-green-600 rounded-lg bg-white dark:bg-gray-800 p-6">

                {{-- IMAGE PREVIEW --}}
                @if ($isImage)
                    <div class="mb-4">
                        @if (is_object($file))
                            <img src="{{ $file->temporaryUrl() }}" alt="Preview"
                                class="max-h-48 mx-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        @else
                            <img src="{{ Storage::url($file) }}" alt="Preview"
                                class="max-h-48 mx-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        @endif
                    </div>
                @endif

                {{-- FILE INFO --}}
                <div class="flex items-start gap-3">
                    {{-- FILE ICON --}}
                    @if (!$isImage)
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            @php
                                $iconColor = match ($extension) {
                                    'pdf' => 'text-red-600 dark:text-red-400',
                                    'doc', 'docx' => 'text-blue-600 dark:text-blue-400',
                                    'xls', 'xlsx' => 'text-green-600 dark:text-green-400',
                                    'ppt', 'pptx' => 'text-orange-600 dark:text-orange-400',
                                    'zip', 'rar', '7z' => 'text-yellow-600 dark:text-yellow-400',
                                    default => 'text-gray-600 dark:text-gray-400',
                                };
                            @endphp
                            <svg class="w-6 h-6 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    @else
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif

                    {{-- FILE DETAILS --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                            {{ $fileName }}
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            @if (is_object($file))
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ number_format($fileSize / 1024, 2) }} KB
                                </span>
                            @else
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Tersimpan
                                </span>
                            @endif
                            <span class="text-xs text-gray-400 dark:text-gray-500">•</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 uppercase">
                                {{ $extension }}
                            </span>
                        </div>
                    </div>

                    {{-- CHANGE BUTTON --}}
                    <label for="{{ $model }}"
                        class="flex-shrink-0 inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/30 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Ganti
                    </label>
                </div>
            </div>
        @endif

        {{-- LOADING STATE --}}
        <div wire:loading wire:target="{{ $model }}"
            class="absolute inset-0 bg-white/90 dark:bg-gray-800/90 rounded-lg flex items-center justify-center">
            <div class="flex items-center gap-3 px-4 py-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-sm font-medium text-blue-700 dark:text-blue-400">
                    Mengupload...
                </span>
            </div>
        </div>
    </div>

    {{-- ERROR MESSAGE --}}
    @error($model)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
