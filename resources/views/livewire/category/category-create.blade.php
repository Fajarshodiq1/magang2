<div class="min-h-screen">
    <div class="container mx-auto px-2 mt-2">
        <div class="bg-white p-7 rounded-3xl mb-8">
            <!-- Header Section -->
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Tambah Kategori Baru</h1>

                    <!-- Breadcrumb -->
                    <nav class="flex items-center space-x-2 text-sm">
                        <a href="/categories" wire:navigate class="text-gray-500 hover:text-gray-700 font-medium">
                            <i class="fas fa-home"></i>
                        </a>
                        <span class="text-gray-400">/</span>
                        <a href="" wire:navigate class="text-gray-500 hover:text-gray-700 font-medium">
                            Category
                        </a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-medium">Tambah Baru</span>
                    </nav>
                </div>

                <!-- Back Button -->
                <a href="/documents" wire:navigate
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-full">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-zinc-800 rounded-3xl p-8">
        <form wire:submit="save">
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nama <span class="text-red-500 dark:text-red-400">*</span>
                </label>
                <input type="text" id="name" wire:model="name" placeholder="Masukkan Nama Kategori"
                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 rounded-full focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 focus:border-transparent
                               @error('name') border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-900/50 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                <a href="/categories" wire:navigate
                    class="px-6 py-2.5 border border-gray-300 dark:border-zinc-600 rounded-full text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-full font-medium
                            disabled:opacity-50 disabled:cursor-not-allowed flex items-center"
                    wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save" class="flex items-center">
                        <i class="fas fa-save mr-2"></i>Simpan Kategori
                    </span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
