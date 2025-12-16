<div class="min-h-screen transition-colors duration-200">

    <div class="min-h-screen bg-white dark:bg-zinc-900 rounded-2xl transition-colors duration-200">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-4">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dokumen</h1>
                    <span
                        class="px-3 py-1 text-sm bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg">
                        {{ $documents->total() }} File
                    </span>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Add Document Button -->
                    <a href="/documents/create" wire:navigate
                        class="flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700 text-white rounded-full transition font-medium">
                        <i class="fas fa-plus mr-2"></i>Tambah Dokumen
                    </a>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session()->has('success'))
                <div
                    class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Section -->
            <div
                class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pencarian</label>
                        <div class="relative">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Cari judul, deskripsi, atau nama file..."
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 focus:border-transparent transition">
                        </div>
                    </div>

                    <!-- File Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe File</label>
                        <select wire:model.live="fileType"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 focus:border-transparent transition">
                            <option value="">Semua Tipe</option>
                            <option value="pdf">PDF</option>
                            <option value="doc">DOC</option>
                            <option value="docx">DOCX</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div
                class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900">
                            <tr>
                                {{-- pembuat --}}
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
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
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
