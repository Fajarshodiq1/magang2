<div class="min-h-screen transition-colors duration-200">
    <div
        class="flex justify-between items-center mb-8 bg-white dark:bg-zinc-900 rounded-2xl p-6 sm:p-8 transition-colors duration-200">
        <div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $documents->total() }} Total
                    Dokumen
                </h1>
            </div>
            <h2 class="text-gray-600 dark:text-gray-400 font-semibold text-[15px] mt-2">Lihat dan kelola dokumen
                Anda
                disini</h2>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Add Document Button -->
            <a href="/documents/create" wire:navigate
                class="flex items-center space-x-2 px-6 py-3 font-semibold bg-green-700 hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-700 text-white rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>
                    Tambah Dokumen
                </span>
            </a>
        </div>
    </div>
    <div class="bg-white dark:bg-zinc-900 rounded-2xl sm:rounded-[14px] p-4 sm:p-8 mb-4 sm:mb-6">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#7F8190] dark:text-zinc-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h3 class="text-xs sm:text-sm font-semibold text-[#0A090B] dark:text-white uppercase tracking-wide">
                Filter & Pencarian
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <!-- Pencarian -->
            <div>
                <label class="block text-xs sm:text-sm font-bold text-[#0A090B] dark:text-white mb-2">
                    Pencarian
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#7F8190] dark:text-zinc-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Cari judul, deskripsi, atau nama file..."
                        class="w-full h-11 sm:h-[52px] pl-10 sm:pl-12 pr-3 sm:pr-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-800 text-sm text-[#0A090B] dark:text-white font-semibold placeholder:text-[#7F8190] placeholder:font-semibold outline-none focus:border-indigo-800 focus:ring-1 focus:ring-indigo-800 transition-all dark:focus:ring-white dark:focus:border-white">
                </div>
            </div>

            <!-- Tipe File Filter -->
            <div>
                <label class="block text-xs sm:text-sm font-bold text-[#0A090B] dark:text-white mb-2">
                    Tipe File
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none z-10">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#7F8190] dark:text-zinc-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <select wire:model.live="fileType"
                        class="w-full h-11 sm:h-[52px] pl-10 sm:pl-12 pr-10 sm:pr-12 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-800 text-sm text-[#0A090B] dark:text-white font-semibold outline-none focus:border-indigo-800 focus:ring-1 focus:ring-indigo-800 dark:focus:border-white dark:focus:ring-white transition-all appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="pdf">PDF</option>
                        <option value="doc">DOC</option>
                        <option value="docx">DOCX</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 sm:pr-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#7F8190] dark:text-zinc-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="min-h-screen bg-white dark:bg-zinc-900 rounded-2xl transition-colors duration-200">
        <div class="container mx-auto px-8 py-4">
            <!-- Table -->
            {{-- <div
                class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Pembuat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-800 transition"
                                    wire:click="sortBy('title')">
                                    <div class="flex items-center space-x-1">
                                        <span>Judul</span>
                                        @if ($sortField === 'title')
                                            <i
                                                class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-green-600"></i>
                                        @endif
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    File
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Ukuran
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-800 transition"
                                    wire:click="sortBy('created_at')">
                                    <div class="flex items-center space-x-1">
                                        <span>Tanggal Upload</span>
                                        @if ($sortField === 'created_at')
                                            <i
                                                class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-green-600"></i>
                                        @endif
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($documents as $document)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-900/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $document->user ? $document->user->name : 'Unknown' }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                            {{ $document->user ? $document->user->email : '' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $document->title }}</div>
                                        @if ($document->description)
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                                {{ Str::limit($document->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="px-2.5 py-1 text-xs font-semibold rounded-md 
                                                {{ $document->file_type === 'pdf'
                                                    ? 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
                                                    : 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800' }}">
                                                {{ strtoupper($document->file_type) }}
                                            </span>
                                            <span
                                                class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($document->file_name, 30) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $document->formatted_file_size }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $document->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end items-center space-x-3">
                                            <button wire:click="preview({{ $document->id }})"
                                                class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 transition"
                                                title="Preview">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <a href="{{ route('documents.download', $document->id) }}"
                                                class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 transition"
                                                title="Download">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16" />
                                                </svg>
                                            </a>

                                            <a href="/documents/{{ $document->id }}/edit" wire:navigate
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 4h9M4 20l4-1 11-11a2.5 2.5 0 10-3.5-3.5L4.5 15.5 4 20z" />
                                                </svg>
                                            </a>

                                            <button
                                                wire:click="$dispatch('delete-confirm', { id: {{ $document->id }} })"
                                                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 7h12M9 7V4h6v3M8 7l1 13h6l1-13" />
                                                </svg>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div
                                            class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                            <i class="fas fa-folder-open text-5xl mb-3"></i>
                                            <p class="text-lg font-medium">Tidak ada dokumen ditemukan</p>
                                            <p class="text-sm mt-1">Mulai dengan menambahkan dokumen baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900">
                    {{ $documents->links() }}
                </div>
            </div> --}}
            {{-- devider --}}
            <div class="py-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Dokumen Terbaru</h2>
            </div>
            <div class="w-full overflow-x-auto flex flex-col space-y-6">
                @forelse ($documents as $document)
                    <div class="w-full flex flex-col">
                        <!-- Desktop View -->
                        <div
                            class="hidden lg:grid lg:grid-cols-12 lg:gap-4 w-full px-5 py-7 rounded-2xl hover:bg-gray-50 dark:hover:bg-zinc-900/50 transition">
                            <!-- User Info -->
                            <div class="col-span-3 flex items-center gap-4 min-w-0">
                                <img src="{{ Storage::url($document->user->profile_photo) }}" alt="User Avatar"
                                    class="h-12 w-12 rounded-full object-cover flex-shrink-0">
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                        {{ $document->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 font-semibold truncate">
                                        {{ $document->user->email }}
                                    </div>
                                </div>
                            </div>

                            <!-- File Type -->
                            <div class="col-span-1 flex items-center justify-center">
                                <span
                                    class="px-3.5 py-2 text-xs font-bold rounded-full whitespace-nowrap
                        {{ $document->file_type === 'pdf'
                            ? 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
                            : 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800' }}">
                                    {{ strtoupper($document->file_type) }}
                                </span>
                            </div>

                            <!-- Document Info -->
                            <div class="col-span-3 flex flex-col justify-center min-w-0">
                                <div class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                    {{ $document->title }}
                                </div>
                                @if ($document->description)
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 font-semibold truncate">
                                        {{ Str::limit($document->description, 50) }}
                                    </div>
                                @endif
                            </div>

                            <!-- File Size -->
                            <div class="col-span-1 flex items-center justify-center">
                                <div class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $document->formatted_file_size }}
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="col-span-2 flex items-center justify-center">
                                <div class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $document->created_at->format('d M Y H:i') }}
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-span-2 flex items-center justify-end gap-2">
                                <a href="/documents/{{ $document->id }}/edit" wire:navigate
                                    class="px-7 py-3 bg-blue-100 text-blue-600 font-bold rounded-full text-sm hover:bg-blue-200 transition whitespace-nowrap">
                                    Edit
                                </a>
                                <button wire:click="$dispatch('delete-confirm', { id: {{ $document->id }} })"
                                    class="px-7 py-3 bg-red-100 text-red-600 font-bold rounded-full text-sm hover:bg-red-200 transition whitespace-nowrap">
                                    Delete
                                </button>
                            </div>
                        </div>

                        <!-- Mobile/Tablet View -->
                        <div
                            class="lg:hidden w-full p-4 space-y-4 rounded-2xl hover:bg-gray-50 dark:hover:bg-zinc-900/50 transition">
                            <!-- User Info & File Type -->
                            <div class="flex items-center gap-3">
                                <img src="{{ Storage::url($document->user->profile_photo) }}" alt="User Avatar"
                                    class="h-12 w-12 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                        {{ $document->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 font-semibold truncate">
                                        {{ $document->user->email }}
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1.5 rounded-full text-xs font-bold flex-shrink-0
                        {{ $document->file_type === 'pdf'
                            ? 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
                            : 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800' }}">
                                    {{ strtoupper($document->file_type) }}
                                </span>
                            </div>

                            <!-- Document Info -->
                            <div class="space-y-1">
                                <div class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                    {{ $document->title }}
                                </div>
                                @if ($document->description)
                                    <div class="text-sm text-gray-500 dark:text-gray-400 font-semibold line-clamp-2">
                                        {{ $document->description }}
                                    </div>
                                @endif
                            </div>

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between text-sm">
                                <div class="font-bold text-gray-900 dark:text-white">
                                    {{ $document->formatted_file_size }}
                                </div>
                                <div class="font-bold text-gray-900 dark:text-white">
                                    {{ $document->created_at->format('d M Y H:i') }}
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <a href="/documents/{{ $document->id }}/edit" wire:navigate
                                    class="flex-1 px-4 py-2 bg-blue-100 text-blue-600 font-bold rounded-full text-sm text-center hover:bg-blue-200 transition">
                                    Edit
                                </a>
                                <button wire:click="$dispatch('delete-confirm', { id: {{ $document->id }} })"
                                    class="flex-1 px-4 py-2 bg-red-100 text-red-600 font-bold rounded-full text-sm hover:bg-red-200 transition">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400 dark:text-gray-500">
                        <i class="fas fa-folder-open text-5xl mb-3"></i>
                        <p class="text-lg font-medium">Tidak ada dokumen ditemukan</p>
                        <p class="text-sm mt-1">Mulai dengan menambahkan dokumen baru</p>
                    </div>
                @endforelse

                <div class="px-6 py-4">
                    {{ $documents->links('pagination::tailwind') }}
                </div>
            </div>

        </div>

        <!-- Preview Modal -->
        @if ($showPreview && $previewDocument)
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/60 dark:bg-black/80 backdrop-blur-sm transition-opacity"
                    wire:click="closePreview"></div>

                <!-- Modal -->
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="relative bg-white dark:bg-zinc-800 rounded-xl shadow-2xl border border-gray-200 dark:border-zinc-700 w-full max-w-6xl max-h-[90vh] flex flex-col"
                        @click.stop>
                        <!-- Header -->
                        <div
                            class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-zinc-700">
                            <div class="flex-1 min-w-0 mr-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">
                                    {{ $previewDocument->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                    {{ $previewDocument->file_name }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('documents.download', $previewDocument->id) }}"
                                    class="flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium">
                                    <i class="fas fa-download mr-2"></i>Download
                                </a>
                                <button wire:click="closePreview"
                                    class="p-2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Preview Content -->
                        <div class="flex-1 overflow-hidden bg-gray-100 dark:bg-zinc-900">
                            @if ($previewDocument->file_type === 'pdf')
                                <iframe src="{{ Storage::url($previewDocument->file_path) }}" class="w-full h-full"
                                    style="min-height: 600px;" frameborder="0"></iframe>
                            @else
                                <iframe
                                    src="https://docs.google.com/viewer?url={{ urlencode(url(Storage::url($previewDocument->file_path))) }}&embedded=true"
                                    class="w-full h-full" style="min-height: 600px;" frameborder="0">
                                    <div class="flex items-center justify-center h-full">
                                        <div class="text-center p-8 bg-white dark:bg-zinc-800 rounded-lg">
                                            <i
                                                class="fas fa-file-word text-6xl text-blue-500 dark:text-blue-400 mb-4"></i>
                                            <p class="text-gray-700 dark:text-gray-300 mb-4 font-medium">Preview tidak
                                                tersedia untuk file ini.</p>
                                            <a href="{{ route('documents.download', $previewDocument->id) }}"
                                                class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium">
                                                <i class="fas fa-download mr-2"></i>Download untuk melihat
                                            </a>
                                        </div>
                                    </div>
                                </iframe>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="p-4 border-t border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900">
                            <div class="flex items-center justify-between text-sm">
                                <div class="text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">Ukuran:</span>
                                    <span class="ml-1">{{ $previewDocument->formatted_file_size }}</span>
                                </div>
                                <div class="text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">Diupload:</span>
                                    <span
                                        class="ml-1">{{ $previewDocument->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div>
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-md
                                        {{ $previewDocument->file_type === 'pdf'
                                            ? 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800'
                                            : 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800' }}">
                                        {{ strtoupper($previewDocument->file_type) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('delete-confirm', (event) => {
                if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
                    Livewire.dispatch('delete-document', {
                        id: event.id
                    });
                }
            });
        });
    </script>
</div>
