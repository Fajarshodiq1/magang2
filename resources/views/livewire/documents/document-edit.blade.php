<div class="min-h-screen">
    <div class="container mx-auto md:px-2 lg:mt-2">
        <!-- Header -->
        <div class="mb-6 lg:mb-12">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h1 class="lg:text-3xl font-bold text-gray-900 mb-4 dark:text-white">Edit Dokumen</h1>
                    <nav class="flex items-center space-x-2 text-sm">
                        <a href="/documents" wire:navigate
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-300 font-medium">
                            Dokumen
                        </a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-medium dark:text-white">Edit</span>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="bg-white dark:bg-zinc-900 rounded-3xl p-4 sm:p-6 mb-8 border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center justify-between relative">
                <!-- Progress Line Background -->
                <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200 dark:bg-zinc-700 -z-10"></div>
                <div class="absolute top-5 left-0 h-1 bg-emerald-500 dark:bg-emerald-600 transition-all duration-500 -z-10"
                    style="width: {{ (($currentStep - 1) / 4) * 100 }}%"></div>

                <!-- Step 1 -->
                <div class="flex flex-col items-center flex-1">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm sm:text-base font-bold transition-all
                {{ $currentStep >= 1 ? 'bg-emerald-500 dark:bg-emerald-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-500 dark:text-zinc-400' }}">
                        @if ($currentStep > 1)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @else
                            1
                        @endif
                    </div>
                    <span
                        class="text-[10px] sm:text-xs mt-1.5 sm:mt-2 font-medium text-center {{ $currentStep >= 1 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-zinc-400' }}">
                        Keamanan
                    </span>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center flex-1">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm sm:text-base font-bold transition-all
                {{ $currentStep >= 2 ? 'bg-emerald-500 dark:bg-emerald-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-500 dark:text-zinc-400' }}">
                        @if ($currentStep > 2)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @else
                            2
                        @endif
                    </div>
                    <span
                        class="text-[10px] sm:text-xs mt-1.5 sm:mt-2 font-medium text-center {{ $currentStep >= 2 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-zinc-400' }}">
                        Info Dasar
                    </span>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center flex-1">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm sm:text-base font-bold transition-all
                {{ $currentStep >= 3 ? 'bg-emerald-500 dark:bg-emerald-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-500 dark:text-zinc-400' }}">
                        @if ($currentStep > 3)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @else
                            3
                        @endif
                    </div>
                    <span
                        class="text-[10px] sm:text-xs mt-1.5 sm:mt-2 font-medium text-center {{ $currentStep >= 3 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-zinc-400' }}">
                        Detail Arsip
                    </span>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center flex-1">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm sm:text-base font-bold transition-all
                {{ $currentStep >= 4 ? 'bg-emerald-500 dark:bg-emerald-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-500 dark:text-zinc-400' }}">
                        @if ($currentStep > 4)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        @else
                            4
                        @endif
                    </div>
                    <span
                        class="text-[10px] sm:text-xs mt-1.5 sm:mt-2 font-medium text-center {{ $currentStep >= 4 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-zinc-400' }}">
                        Retensi
                    </span>
                </div>

                <!-- Step 5 -->
                <div class="flex flex-col items-center flex-1">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm sm:text-base font-bold transition-all
                {{ $currentStep >= 5 ? 'bg-emerald-500 dark:bg-emerald-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-500 dark:text-zinc-400' }}">
                        5
                    </div>
                    <span
                        class="text-[10px] sm:text-xs mt-1.5 sm:mt-2 font-medium text-center {{ $currentStep >= 5 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-zinc-400' }}">
                        Upload File
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-zinc-800 rounded-3xl p-3 md:p-6 lg:p-8 mb-8 border border-gray-200 dark:border-zinc-700">
            <form wire:submit="update">

                <!-- Step 1: Security Section -->
                <div class="{{ $currentStep === 1 ? 'block' : 'hidden' }}">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-shield-alt mr-2 text-red-500"></i>Keamanan Dokumen
                    </h3>

                    <label
                        class="flex items-start gap-3 cursor-pointer p-4 bg-gray-50 dark:bg-zinc-800/50 rounded-xl hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">
                        <input type="checkbox" wire:model.live="is_confidential"
                            class="w-5 h-5 text-red-600 border-gray-300 dark:border-zinc-600 rounded focus:ring-red-500 mt-0.5">
                        <div class="flex-1">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                Tandai sebagai Dokumen Rahasia
                            </span>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                Dokumen akan dilindungi dengan hashing, QR code kepemilikan, dan audit log otomatis
                            </p>
                        </div>
                    </label>

                    @if ($is_confidential)
                        <div class="mt-6 space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Tingkat Keamanan <span class="text-red-500">*</span>
                                </label>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <!-- Normal -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" wire:model.live="security_level" value="normal"
                                            class="peer sr-only">
                                        <div
                                            class="p-4 border-2 rounded-xl transition-all peer-checked:border-gray-500 peer-checked:bg-gray-50 dark:peer-checked:bg-zinc-800 border-gray-200 dark:border-zinc-700 hover:border-gray-400 dark:hover:border-zinc-600 hover:shadow-md">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 dark:bg-zinc-700 flex items-center justify-center transition-colors peer-checked:bg-gray-500 peer-checked:text-white">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="font-bold text-gray-900 dark:text-white">Normal</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Akses standar
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Rahasia -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" wire:model.live="security_level" value="rahasia"
                                            class="peer sr-only">
                                        <div
                                            class="p-4 border-2 rounded-xl transition-all peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/20 border-gray-200 dark:border-zinc-700 hover:border-orange-400 dark:hover:border-orange-600 hover:shadow-md">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center transition-colors peer-checked:bg-orange-500 peer-checked:text-white">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="font-bold text-gray-900 dark:text-white">Rahasia</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Akses
                                                        terbatas</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Sangat Rahasia -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" wire:model.live="security_level" value="sangat_rahasia"
                                            class="peer sr-only">
                                        <div
                                            class="p-4 border-2 rounded-xl transition-all peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 border-gray-200 dark:border-zinc-700 hover:border-red-400 dark:hover:border-red-600 hover:shadow-md">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center transition-colors peer-checked:bg-red-500 peer-checked:text-white">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="font-bold text-gray-900 dark:text-white">Sangat Rahasia
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Akses ketat
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Security Features Info -->
                            <div
                                class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-emerald-900 dark:text-emerald-100 mb-2">
                                            Fitur keamanan yang akan diterapkan:</p>
                                        <ul class="text-xs text-emerald-800 dark:text-emerald-200 space-y-1">
                                            <li class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>SHA-256 hashing untuk verifikasi integritas</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>QR Code kepemilikan dengan enkripsi data</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>File checksum untuk deteksi perubahan</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Audit log setiap akses dokumen</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Watermark otomatis pada preview</span>
                                            </li>
                                            @if ($security_level === 'sangat_rahasia')
                                                <li
                                                    class="flex items-start gap-2 text-red-600 dark:text-red-400 font-semibold">
                                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>Enkripsi end-to-end untuk dokumen Sangat Rahasia</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Step 2: Basic Information -->
                <div class="{{ $currentStep === 2 ? 'block' : 'hidden' }}">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-info-circle mr-2 text-emerald-500"></i>Informasi Dasar
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-text label="Judul" type="text" name="title"
                            placeholder="Masukkan judul dokumen" required wire:model="title">
                            <x-slot:icon>
                                <x:flux::icon.document-text class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.select name="selectedCategory" label="Kategori Klasifikasi Arsip"
                            wire:model.live="selectedCategory">
                            <x-slot:icon>
                                <x-flux::icon.tag class="w-5 h-5" />
                            </x-slot:icon>
                            <option value="" disabled selected class="text-gray-400 dark:text-gray-500">Pilih
                                Kategori Klasifikasi</option>
                            @foreach ($archiveCategories as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-form.select>

                        <div class="md:col-span-2">
                            <x-form.select name="archive_classification_id" label="Kode Klasifikasi Arsip" required
                                wire:model="archive_classification_id">
                                <x-slot:icon>
                                    <x-flux::icon.computer-desktop class="w-5 h-5" />
                                </x-slot:icon>
                                <option value="">Pilih Kode Klasifikasi Arsip</option>
                                @if ($archiveClassifications->isEmpty())
                                    <option value="" disabled>
                                        {{ $selectedCategory ? 'Tidak ada klasifikasi untuk kategori ini' : 'Silakan pilih kategori terlebih dahulu' }}
                                    </option>
                                @else
                                    @foreach ($archiveClassifications as $classification)
                                        <option value="{{ $classification->id }}">
                                            {{ $classification->code }} - {{ $classification->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </x-form.select>
                            @if ($selectedCategory && $archiveClassifications->isEmpty())
                                <p class="mt-2 text-sm text-amber-600 dark:text-amber-400">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Belum ada kode klasifikasi untuk kategori ini.
                                    <a href="/archive-classifications/create" wire:navigate
                                        class="underline font-semibold hover:text-amber-700">
                                        Tambah kode klasifikasi baru
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Jenis Arsip
                                <span class="text-red-500 dark:text-red-400">*</span>
                            </label>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Terbuka (Hijau) -->
                                <label class="relative cursor-pointer h-full">
                                    <input type="radio" name="jenis_arsip" value="Terbuka"
                                        wire:model="jenis_arsip" class="peer sr-only">
                                    <div
                                        class="h-full p-5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 
                                        rounded-2xl transition-all duration-200
                                        peer-checked:border-emerald-500 peer-checked:bg-emerald-50 
                                        dark:peer-checked:border-emerald-600 dark:peer-checked:bg-emerald-950/30
                                        hover:border-gray-400 dark:hover:border-zinc-500
                                        flex flex-col">
                                        <div class="flex flex-col items-center text-center flex-1">
                                            <div
                                                class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30 transition-colors duration-200">
                                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="font-semibold text-gray-900 dark:text-white mb-1">Terbuka</div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Dapat diakses oleh
                                                semua pihak</p>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-emerald-600 dark:text-emerald-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <!-- Terbatas (Kuning) -->
                                <label class="relative cursor-pointer h-full">
                                    <input type="radio" name="jenis_arsip" value="Terbatas"
                                        wire:model="jenis_arsip" class="peer sr-only">
                                    <div
                                        class="h-full p-5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 
                                        rounded-2xl transition-all duration-200
                                        peer-checked:border-yellow-500 peer-checked:bg-yellow-50 
                                        dark:peer-checked:border-yellow-600 dark:peer-checked:bg-yellow-950/30
                                        hover:border-gray-400 dark:hover:border-zinc-500
                                        flex flex-col">
                                        <div class="flex flex-col items-center text-center flex-1">
                                            <div
                                                class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30 transition-colors duration-200">
                                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                            <div class="font-semibold text-gray-900 dark:text-white mb-1">Terbatas
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Akses terbatas untuk
                                                pihak tertentu</p>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-yellow-600 dark:text-yellow-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <!-- Tertutup (Merah) -->
                                <label class="relative cursor-pointer h-full">
                                    <input type="radio" name="jenis_arsip" value="Tertutup"
                                        wire:model="jenis_arsip" class="peer sr-only">
                                    <div
                                        class="h-full p-5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 
                                        rounded-2xl transition-all duration-200
                                        peer-checked:border-red-500 peer-checked:bg-red-50 
                                        dark:peer-checked:border-red-600 dark:peer-checked:bg-red-950/30
                                        hover:border-gray-400 dark:hover:border-zinc-500
                                        flex flex-col">
                                        <div class="flex flex-col items-center text-center flex-1">
                                            <div
                                                class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30 transition-colors duration-200">
                                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <div class="font-semibold text-gray-900 dark:text-white mb-1">Tertutup
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Hanya dapat diakses
                                                dengan izin khusus</p>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-red-600 dark:text-red-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            @error('jenis_arsip')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <x-form.textarea label="Deskripsi" name="description"
                            placeholder="Tambahkan deskripsi dokumen (opsional)" wire:model="description"
                            rows="7" />

                        <x-form.input-text label="Tahun" type="text" name="tahun"
                            placeholder="Masukkan tahun dokumen" required wire:model="tahun">
                            <x-slot:icon>
                                <x:flux::icon.calendar-days class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.select name="category_id" label="Kategori Simpan" required wire:model="category_id">
                            <x-slot:icon>
                                <x-flux::icon.tag class="w-5 h-5" />
                            </x-slot:icon>
                            <option value="">Pilih Kategori</option>
                            @foreach (\App\Models\Category::orderBy('name')->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>

                <!-- Step 3: Archive Details -->
                <div class="{{ $currentStep === 3 ? 'block' : 'hidden' }}">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-file-alt mr-2 text-emerald-500"></i>Detail Arsip
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Perkembangan <span class="text-red-500">*</span>
                            </label>

                            <button type="button" @click="open = !open"
                                class="w-full bg-white border font-semibold text-sm border-gray-300 rounded-full px-5 py-3 text-left flex items-center justify-between hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <span class="text-gray-700">
                                    @if ($tingkat_perkembangan)
                                        {{ $tingkat_perkembangan === 'Lainnya' ? $tingkat_perkembangan_lainnya ?? 'Lainnya (belum diisi)' : $tingkat_perkembangan }}
                                    @else
                                        Pilih Tingkat Perkembangan
                                    @endif
                                </span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute z-10 w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden"
                                style="display: none;">
                                <div class="p-2 space-y-2 max-h-80 overflow-y-auto">
                                    <div wire:click="$set('tingkat_perkembangan', 'Asli')" @click="open = false"
                                        class="cursor-pointer border-2 rounded-lg p-4 transition-all hover:shadow-md {{ $tingkat_perkembangan === 'Asli' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-emerald-300 hover:bg-gray-50' }}">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 {{ $tingkat_perkembangan === 'Asli' ? 'text-emerald-500' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-800">Asli</div>
                                                <div class="text-xs text-gray-500">Dokumen asli/original</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div wire:click="$set('tingkat_perkembangan', 'Duplikat')" @click="open = false"
                                        class="cursor-pointer border-2 rounded-lg p-4 transition-all hover:shadow-md {{ $tingkat_perkembangan === 'Duplikat' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-emerald-300 hover:bg-gray-50' }}">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 {{ $tingkat_perkembangan === 'Duplikat' ? 'text-emerald-500' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-800">Duplikat</div>
                                                <div class="text-xs text-gray-500">Salinan resmi dokumen</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div wire:click="$set('tingkat_perkembangan', 'Fotocopy')" @click="open = false"
                                        class="cursor-pointer border-2 rounded-lg p-4 transition-all hover:shadow-md {{ $tingkat_perkembangan === 'Fotocopy' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-emerald-300 hover:bg-gray-50' }}">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 {{ $tingkat_perkembangan === 'Fotocopy' ? 'text-emerald-500' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-800">Fotocopy</div>
                                                <div class="text-xs text-gray-500">Fotokopi dokumen</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div wire:click="$set('tingkat_perkembangan', 'Lainnya')" @click="open = false"
                                        class="cursor-pointer border-2 rounded-lg p-4 transition-all hover:shadow-md {{ $tingkat_perkembangan === 'Lainnya' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-emerald-300 hover:bg-gray-50' }}">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 {{ $tingkat_perkembangan === 'Lainnya' ? 'text-emerald-500' : 'text-gray-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-800">Lainnya</div>
                                                <div class="text-xs text-gray-500">Isi manual sesuai kebutuhan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($tingkat_perkembangan === 'Lainnya')
                                <div class="mt-3">
                                    <x-form.input-text label="Sebutkan Tingkat Perkembangan" type="text"
                                        name="tingkat_perkembangan_lainnya"
                                        placeholder="Contoh: Salinan, Petikan, Transkrip, dll" required
                                        wire:model="tingkat_perkembangan_lainnya" />
                                </div>
                            @endif

                            @error('tingkat_perkembangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-form.input-text label="Jumlah" type="number" name="jumlah"
                            placeholder="Masukkan Jumlah" required wire:model="jumlah">
                            <x-slot:icon>
                                <x:flux::icon.bars-arrow-up class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.input-text label="No. Definitif" type="text" name="no_definitif"
                            placeholder="Masukkan No. Definitif" required wire:model="no_definitif">
                            <x-slot:icon>
                                <x:flux::icon.document-magnifying-glass class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.input-text label="Lokasi Simpan" type="text" name="lokasi_simpan"
                            placeholder="Masukkan Lokasi Simpan" required wire:model="lokasi_simpan">
                            <x-slot:icon>
                                <x:flux::icon.map-pin class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>
                    </div>
                </div>

                <!-- Step 4: Retention & Disposition -->
                <div class="{{ $currentStep === 4 ? 'block' : 'hidden' }}">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-clock mr-2 text-orange-500"></i>Retensi & Disposisi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-text label="Retensi Aktif" type="text" name="retensi_aktif"
                            placeholder="Masukkan Retensi Aktif" required wire:model="retensi_aktif">
                            <x-slot:icon>
                                <x:flux::icon.clock class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.input-text label="Retensi Inaktif" type="text" name="retensi_inaktif"
                            placeholder="Masukkan Retensi Inaktif" required wire:model="retensi_inaktif">
                            <x-slot:icon>
                                <x:flux::icon.clock class="w-5 h-5" />
                            </x-slot:icon>
                        </x-form.input-text>

                        <x-form.select name="nasib_akhir" label="Nasib Akhir" required wire:model="nasib_akhir">
                            <x-slot:icon>
                                <x:flux::icon.trash class="w-5 h-5" />
                            </x-slot:icon>
                            <option value="">Pilih Nasib Akhir</option>
                            <option value="Musnah">Musnah</option>
                            <option value="Dinilai Kembali">Dinilai Kembali</option>
                            <option value="Permanen">Permanen</option>
                        </x-form.select>

                        <div class="md:col-span-2">
                            <x-form.input-text label="Keterangan" type="text" name="keterangan"
                                placeholder="Masukkan Keterangan" required wire:model="keterangan">
                                <x-slot:icon>
                                    <x:flux::icon.document-text class="w-5 h-5" />
                                </x-slot:icon>
                            </x-form.input-text>
                        </div>
                    </div>
                </div>

                <!-- Step 5: File Upload -->
                <div class="{{ $currentStep === 5 ? 'block' : 'hidden' }}">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-upload mr-2 text-indigo-500"></i>Upload Dokumen / Gambar
                    </h3>

                    <!-- Info File Saat Ini -->
                    <div
                        class="mb-6 p-6 bg-gray-50 dark:bg-zinc-700 rounded-2xl border border-gray-200 dark:border-zinc-600">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                    <i
                                        class="fas fa-file-{{ $document->file_type === 'pdf' ? 'pdf' : ($document->file_type === 'docx' || $document->file_type === 'doc' ? 'word' : 'image') }} text-2xl {{ $document->file_type === 'pdf' ? 'text-red-600' : 'text-blue-600' }}"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">File Saat Ini:
                                </p>
                                <p class="text-base font-medium text-gray-900 dark:text-white mb-2">
                                    {{ $existingFileName }}</p>
                                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-tag"></i>
                                        {{ strtoupper($document->file_type) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-weight"></i>
                                        {{ $document->formatted_file_size }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-calendar"></i>
                                        {{ $document->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-form.file-upload model="file"
                        label="Upload File Baru - Opsional (PDF, DOC, DOCX, JPG, PNG, GIF, WEBP)"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp" maxSize="10MB" :file="$file" />

                    @if ($file)
                        <div
                            class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                            <div class="flex items-start gap-2">
                                <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mt-0.5"></i>
                                <div class="text-sm text-amber-800 dark:text-amber-300">
                                    <p class="font-semibold">Perhatian:</p>
                                    <p>File lama akan dihapus dan diganti dengan file baru yang Anda upload.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Summary Section -->
                    <div
                        class="mt-8 p-6 bg-gradient-to-br from-emerald-50 to-indigo-50 dark:from-emerald-900/20 dark:to-indigo-900/20 rounded-2xl border border-emerald-200 dark:border-emerald-800">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-clipboard-check mr-2 text-emerald-600"></i>
                            Ringkasan Data Dokumen
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Judul:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $title ?: '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Jenis Arsip:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $jenis_arsip ?: '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tahun:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $tahun ?: '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tingkat Keamanan:</span>
                                    <span
                                        class="font-semibold {{ $is_confidential ? 'text-red-600' : 'text-emerald-600' }}">
                                        {{ $is_confidential ? ucfirst(str_replace('_', ' ', $security_level)) : 'Normal' }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tingkat Perkembangan:</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $tingkat_perkembangan === 'Lainnya' ? ($tingkat_perkembangan_lainnya ?: '-') : ($tingkat_perkembangan ?: '-') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Jumlah:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $jumlah ?: '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Nasib Akhir:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $nasib_akhir ?: '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">File:</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ $file ? $file->getClientOriginalName() : $existingFileName }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center pt-6 mt-6 border-t border-gray-200 dark:border-zinc-700">
                    <!-- Back Button -->
                    @if ($currentStep > 1)
                        <x-ui.button type="button" variant="secondary" wire:click="previousStep">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Sebelumnya
                        </x-ui.button>
                    @else
                        <x-ui.button variant="secondary" href="/documents" wire:navigate>
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </x-ui.button>
                    @endif

                    <!-- Next/Submit Button -->
                    <div class="flex gap-3">
                        @if ($currentStep < 5)
                            <x-ui.button type="button" wire:click="nextStep">
                                Selanjutnya
                                <i class="fas fa-arrow-right ml-2"></i>
                            </x-ui.button>
                        @else
                            <x-ui.button type="submit" loading="update">
                                <i class="fas fa-save mr-2"></i>
                                Update Dokumen
                            </x-ui.button>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div
            class="mt-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl sm:rounded-3xl p-3 sm:p-4">
            <div class="flex items-start gap-2 sm:gap-3">
                <div class="text-xs sm:text-sm text-emerald-800 dark:text-emerald-300 flex-1 min-w-0">
                    <p class="font-semibold mb-1 sm:mb-1.5">Informasi Edit:</p>
                    <ul class="list-disc list-inside space-y-0.5 sm:space-y-1 text-emerald-700 dark:text-emerald-400">
                        <li class="leading-relaxed">Format file yang didukung: PDF, DOC, DOCX, JPG, PNG, GIF, WEBP</li>
                        <li class="leading-relaxed">Ukuran maksimal file: 10 MB</li>
                        <li class="leading-relaxed">File hanya akan diganti jika Anda mengupload file baru</li>
                        <li class="leading-relaxed">Kode klasifikasi menggunakan standar KMA 44/2010</li>
                        <li class="leading-relaxed">Perubahan tingkat keamanan akan memperbarui hash dan QR code</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/cdn.min.js" defer></script>
</div>
