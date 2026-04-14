<div class="min-h-screen">
    <div class="container mx-auto px-2 mt-2">
        <!-- Header -->
        <div class="bg-white p-7 rounded-3xl mb-8">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Tambah Kode Klasifikasi Arsip</h1>
                    <nav class="flex items-center space-x-2 text-sm">
                        <a href="/dashboard" wire:navigate class="text-gray-500 hover:text-gray-700 font-medium">
                            <i class="fas fa-home"></i>
                        </a>
                        <span class="text-gray-400">/</span>
                        <a href="/archive-classifications" wire:navigate
                            class="text-gray-500 hover:text-gray-700 font-medium">
                            Kode Klasifikasi Arsip
                        </a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-medium">Tambah Baru</span>
                    </nav>
                </div>
                <x-ui.button variant="secondary" href="/archive-classifications" wire:navigate>
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </x-ui.button>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-3xl p-5">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5 mr-3"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-2">Panduan Pengisian Kode Klasifikasi:</p>
                    <ul class="list-disc list-inside space-y-1 text-blue-700">
                        <li>Kode harus unik dan mengikuti format standar (contoh: OT.00, HM.01, KP.02.1)</li>
                        <li>Nama klasifikasi harus jelas dan deskriptif</li>
                        <li>Kategori dipilih berdasarkan klasifikasi utama sesuai KMA Nomor 44 Tahun 2010</li>
                        <li>Deskripsi dapat membantu penjelasan lebih detail tentang klasifikasi ini</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-3xl p-8">
            <form wire:submit="save">
                <!-- Informasi Klasifikasi -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-tag mr-2 text-blue-500"></i>Informasi Klasifikasi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-text label="Kode Klasifikasi" type="text" name="code"
                            placeholder="Contoh: OT.00, HM.01, KP.02.1" required wire:model="code" />

                        <x-form.select name="category" label="Kategori Utama" required wire:model="category">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categoryOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-form.select>

                        <div class="md:col-span-2">
                            <x-form.input-text label="Nama Klasifikasi" type="text" name="name"
                                placeholder="Contoh: Organisasi, Tata Laksana, Perencanaan" required
                                wire:model="name" />
                        </div>

                        <div class="md:col-span-2">
                            <x-form.textarea label="Deskripsi" name="description"
                                placeholder="Tambahkan deskripsi detail tentang klasifikasi ini (opsional)"
                                wire:model="description" />
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-toggle-on mr-2 text-green-500"></i>Status
                    </h3>
                    <div class="flex items-center space-x-3">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_active"
                                class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">
                                Aktif (Dapat digunakan untuk dokumen)
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end items-center space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                    <x-ui.button type="submit" loading="save">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Kode Klasifikasi
                    </x-ui.button>

                    <x-ui.button variant="secondary" href="/archive-classifications" wire:navigate>
                        Batal
                    </x-ui.button>
                </div>
            </form>
        </div>

        <!-- Reference Card -->
        <div class="mt-6 bg-purple-50 border border-purple-200 rounded-3xl p-5">
            <div class="flex items-start">
                <i class="fas fa-book text-purple-500 text-xl mt-0.5 mr-3"></i>
                <div class="text-sm text-purple-800">
                    <p class="font-semibold mb-2">Contoh Kode Klasifikasi yang Valid:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-purple-700">
                        <div class="bg-white rounded-lg p-3">
                            <p class="font-mono font-bold text-purple-900">OT.00</p>
                            <p class="text-xs mt-1">Organisasi dan Tata Laksana</p>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <p class="font-mono font-bold text-purple-900">HM.00</p>
                            <p class="text-xs mt-1">Kehumasan - Penerangan</p>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <p class="font-mono font-bold text-purple-900">KP.00</p>
                            <p class="text-xs mt-1">Kepegawaian - Pengadilan</p>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <p class="font-mono font-bold text-purple-900">HK.00</p>
                            <p class="text-xs mt-1">Hukum - Peraturan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
