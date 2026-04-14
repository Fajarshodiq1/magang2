@if ($showImportModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
            wire:click="$set('showImportModal', false)"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl w-full max-w-lg" @click.stop>
                <div class="p-6 border-b border-gray-200 dark:border-zinc-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Import Dokumen dari Excel</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Upload file Excel (.xlsx atau .xls)
                    </p>
                </div>

                <form wire:submit="importDocuments" class="p-6">
                    <div class="mb-6">
                        <label
                            class="block w-full p-8 border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl text-center cursor-pointer hover:border-emerald-500 dark:hover:border-emerald-500 transition">
                            <input type="file" wire:model="importFile" accept=".xlsx,.xls" class="hidden">

                            @if (!$importFile)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-12 h-12 mx-auto text-gray-400 mb-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Klik untuk
                                    upload file Excel</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">XLSX atau XLS (Max: 10MB)
                                </p>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-12 h-12 mx-auto text-emerald-500 mb-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $importFile->getClientOriginalName() }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Klik untuk mengganti file
                                </p>
                            @endif
                        </label>

                        @error('importFile')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" wire:click="$set('showImportModal', false)"
                            class="px-5 py-2.5 border border-gray-300 dark:border-zinc-600 rounded-xl text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition disabled:opacity-50"
                            wire:loading.attr="disabled" wire:target="importDocuments">
                            <span wire:loading.remove wire:target="importDocuments">Import Data</span>
                            <span wire:loading wire:target="importDocuments">Mengimport...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
