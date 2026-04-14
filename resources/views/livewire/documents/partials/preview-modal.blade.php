@if ($showPreview && $previewDocument)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" wire:click="closePreview">
        </div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl w-full max-w-6xl max-h-[90vh] flex flex-col"
                @click.stop>
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-zinc-700">
                    <div class="flex-1 min-w-0 mr-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">
                            {{ $previewDocument->title }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                            {{ $previewDocument->file_name }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('documents.download', $previewDocument->id) }}"
                            class="flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Download
                        </a>
                        <button wire:click="closePreview"
                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-1 overflow-hidden bg-gray-100 dark:bg-zinc-900">
                    @if ($previewDocument->file_type === 'pdf')
                        <iframe src="{{ Storage::url($previewDocument->file_path) }}" class="w-full h-full"
                            style="min-height: 600px;" frameborder="0"></iframe>
                    @else
                        <iframe
                            src="https://docs.google.com/viewer?url={{ urlencode(url(Storage::url($previewDocument->file_path))) }}&embedded=true"
                            class="w-full h-full" style="min-height: 600px;" frameborder="0"></iframe>
                    @endif
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900">
                    <div class="flex items-center justify-between text-sm">
                        <div class="text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Ukuran:</span>
                            <span class="ml-1">{{ $previewDocument->formatted_file_size }}</span>
                        </div>
                        <div class="text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Diupload:</span>
                            <span class="ml-1">{{ $previewDocument->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
