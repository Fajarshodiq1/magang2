<div class="min-h-screen transition-colors duration-200 lg:p-4">
    <!-- Header Section -->
    <div class="mb-8 transition-colors duration-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                            Kode Klasifikasi Arsip
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 font-medium text-sm sm:text-base mt-1">
                            Kelola kode klasifikasi berdasarkan KMA No. 44 Tahun 2010
                        </p>
                    </div>
                </div>
            </div>

            <!-- Add Button -->
            <div>
                <a href="/archive-classifications/create" wire:navigate
                    class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Kode Klasifikasi
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session()->has('success'))
        <div
            class="mb-6 bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 rounded-xl p-4 transition-all">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div
            class="mb-6 bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-800 rounded-xl p-4 transition-all">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <p class="text-sm font-semibold text-red-800 dark:text-red-300">
                    {{ session('error') }}
                </p>
            </div>
        </div>
    @endif

    <!-- Filters & Search Section -->
    <x-filter.card title="Filter & Pencarian">
        <x-filter.search model="search" placeholder="Cari kode, nama, atau kategori..." />

        <x-filter.select label="Kategori" model="categoryFilter">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </x-filter.select>

        <x-filter.select label="Status" model="statusFilter">
            <option value="all">Semua Status</option>
            <option value="active">Aktif</option>
            <option value="inactive">Tidak Aktif</option>
        </x-filter.select>

        <x-filter.reset />
    </x-filter.card>

    <!-- DataTable Section -->
    <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
        <!-- Table Header Actions -->
        <div class="p-4 sm:p-6 bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Kode Klasifikasi</h3>
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $classifications->firstItem() ?? 0 }}</span>
                    -
                    <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $classifications->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $classifications->total() }}</span>
                </span>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-zinc-800/70 border-b border-gray-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-4 sm:px-6 py-3.5 text-left">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Kode
                            </span>
                        </th>
                        <th class="px-4 sm:px-6 py-3.5 text-left min-w-[250px]">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Nama Klasifikasi
                            </span>
                        </th>
                        <th class="px-4 sm:px-6 py-3.5 text-left">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Kategori
                            </span>
                        </th>
                        <th class="px-4 sm:px-6 py-3.5 text-center">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Jumlah Dokumen
                            </span>
                        </th>
                        <th class="px-4 sm:px-6 py-3.5 text-center">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </span>
                        </th>
                        <th class="px-4 sm:px-6 py-3.5 text-center min-w-[120px]">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Aksi
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-800 bg-white dark:bg-zinc-900">
                    @forelse ($classifications as $classification)
                        <tr class="group hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                            <!-- Code -->
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 text-emerald-600 dark:text-emerald-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                        </svg>
                                    </div>
                                    <span class="font-mono font-bold text-emerald-600 dark:text-emerald-400 text-sm">
                                        {{ $classification->code }}
                                    </span>
                                </div>
                            </td>

                            <!-- Name & Description -->
                            <td class="px-4 sm:px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $classification->name }}
                                    </p>
                                    @if ($classification->description)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                            {{ Str::limit($classification->description, 80) }}
                                        </p>
                                    @endif
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="px-4 sm:px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-lg text-xs font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                    {{ $classification->category }}
                                </span>
                            </td>

                            <!-- Document Count -->
                            <td class="px-4 sm:px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 rounded-lg text-xs font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    {{ $classification->documents_count }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-4 sm:px-6 py-4 text-center">
                                <button wire:click="toggleStatus({{ $classification->id }})"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold transition-all
                                        {{ $classification->is_active
                                            ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50'
                                            : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900/50' }}">
                                    @if ($classification->is_active)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Aktif
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Tidak Aktif
                                    @endif
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="/archive-classifications/{{ $classification->id }}/edit" wire:navigate
                                        class="p-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-900/50 rounded-lg transition-all duration-200 group/btn"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 group-hover/btn:scale-110 transition-transform">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <button wire:click="delete({{ $classification->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus kode klasifikasi ini?"
                                        class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 rounded-lg transition-all duration-200 group/btn"
                                        title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 group-hover/btn:scale-110 transition-transform">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div
                                        class="w-20 h-20 mb-4 rounded-full bg-gray-100 dark:bg-zinc-800 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-10 h-10 text-gray-400 dark:text-gray-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        Tidak ada kode klasifikasi
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mb-4">
                                        Mulai dengan menambahkan kode klasifikasi baru atau ubah filter pencarian Anda
                                    </p>
                                    <a href="/archive-classifications/create" wire:navigate
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Tambah Kode Klasifikasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($classifications->hasPages())
            <div
                class="px-4 sm:px-6 py-4 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800">
                {{ $classifications->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    <!-- Info Card -->
    <div
        class="mt-6 bg-emerald-50 dark:bg-emerald-900/20 border-2 border-emerald-200 dark:border-emerald-800 rounded-2xl p-6">
        <div class="flex items-start gap-4">
            <div class="p-2 bg-emerald-600 rounded-lg flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-emerald-900 dark:text-emerald-300 text-base mb-3">
                    Informasi Kode Klasifikasi Arsip:
                </p>
                <ul class="space-y-2 text-sm text-emerald-800 dark:text-emerald-400">
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Berdasarkan KMA Nomor 44 Tahun 2010 tentang Pedoman Penataan Arsip Kementerian
                            Agama</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Kode klasifikasi digunakan untuk mengorganisir dan mengkategorikan dokumen</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Setiap dokumen harus memiliki kode klasifikasi yang sesuai</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
