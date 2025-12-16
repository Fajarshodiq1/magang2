<div class="min-h-screen transition-colors duration-200">

    <div class="min-h-screen bg-white dark:bg-zinc-900 transition-colors duration-200 rounded-2xl">
        <div class="container mx-auto px-10 py-8 max-w-7xl">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Tambah Dokumen Baru</h1>
                    <a href="/documents" wire:navigate
                        class="inline-flex items-center text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 transition font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke daftar dokumen
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-8">
                <form wire:submit="save">
                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Judul <span class="text-red-500 dark:text-red-400">*</span>
                        </label>
                        <input type="text" id="title" wire:model="title" placeholder="Masukkan judul dokumen"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 focus:border-transparent transition
                                   @error('title') border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-900/50 @enderror">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="description" wire:model="description" rows="4" placeholder="Tambahkan deskripsi dokumen (opsional)"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 focus:border-transparent transition resize-none
                                      @error('description') border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-900/50 @enderror"></textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="mb-8">
                        <label for="file" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Upload File (PDF, DOC, DOCX) <span class="text-red-500 dark:text-red-400">*</span>
                        </label>
                        <div
                            class="border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl p-8 text-center transition-colors
                                    hover:border-green-400 dark:hover:border-green-600
                                    @error('file') border-red-500 dark:border-red-500 bg-red-50/50 dark:bg-red-900/10 @enderror
                                    @if ($file) border-green-500 dark:border-green-600 bg-green-50/50 dark:bg-green-900/10 @endif">
                            <input type="file" id="file" wire:model="file" accept=".pdf,.doc,.docx"
                                class="hidden">

                            @if (!$file)
                                <label for="file" class="cursor-pointer block">
                                    <div class="text-gray-600 dark:text-gray-400">
                                        <i
                                            class="fas fa-cloud-upload-alt text-5xl mb-3 text-green-500 dark:text-green-400"></i>
                                        <p class="text-base font-medium text-gray-700 dark:text-gray-300">Klik untuk
                                            upload atau drag & drop file</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">PDF, DOC, DOCX (Max:
                                            10MB)</p>
                                    </div>
                                </label>
                            @endif

                            @if ($file)
                                <div class="space-y-3">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full mb-2">
                                        <i class="fas fa-file-alt text-2xl text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div
                                        class="bg-white dark:bg-zinc-900 rounded-lg p-4 border border-gray-200 dark:border-zinc-700">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                            {{ $file->getClientOriginalName() }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ number_format($file->getSize() / 1024, 2) }} KB
                                        </p>
                                    </div>
                                    <label for="file"
                                        class="inline-flex items-center px-4 py-2 text-sm text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium cursor-pointer transition">
                                        <i class="fas fa-sync-alt mr-2"></i>Ganti File
                                    </label>
                                </div>
                            @endif

                            <div wire:loading wire:target="file" class="mt-4">
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    <span class="text-sm font-medium">Mengupload file...</span>
                                </div>
                            </div>
                        </div>
                        @error('file')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div
                        class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                        <a href="/documents" wire:navigate
                            class="px-6 py-2.5 border border-gray-300 dark:border-zinc-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium
                                disabled:opacity-50 disabled:cursor-not-allowed flex items-center"
                            wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save" class="flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan Dokumen
                            </span>
                            <span wire:loading wire:target="save" class="flex items-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mt-0.5 mr-3"></i>
                    <div class="text-sm text-blue-800 dark:text-blue-300">
                        <p class="font-semibold mb-1">Informasi Upload:</p>
                        <ul class="list-disc list-inside space-y-1 text-blue-700 dark:text-blue-400">
                            <li>Format file yang didukung: PDF, DOC, DOCX</li>
                            <li>Ukuran maksimal file: 10 MB</li>
                            <li>File akan disimpan dengan aman di server</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/cdn.min.js" defer></script>
</div>
