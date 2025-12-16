<div>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Dokumen</h1>
            <a href="/documents" wire:navigate class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke daftar dokumen
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form wire:submit="update">
                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" wire:model="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="description" wire:model="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent
                              @error('description') border-red-500 @enderror"></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current File Info -->
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-700 mb-2">File Saat Ini:</p>
                    <div class="flex items-center">
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $document->file_type === 'pdf' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ strtoupper($document->file_type) }}
                        </span>
                        <span class="ml-2 text-sm text-gray-600">{{ $existingFileName }}</span>
                        <span class="ml-auto text-sm text-gray-500">{{ $document->formatted_file_size }}</span>
                    </div>
                </div>

                <!-- File Upload (Optional) -->
                <div class="mb-6">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload File Baru (Opsional)
                    </label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center
                                @error('file') border-red-500 @enderror">
                        <input type="file" id="file" wire:model="file" accept=".pdf,.doc,.docx" class="hidden">
                        <label for="file" class="cursor-pointer">
                            <div class="text-gray-600">
                                <i class="fas fa-cloud-upload-alt text-4xl mb-2"></i>
                                <p class="text-sm">Klik untuk upload file baru</p>
                                <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX (Max: 10MB)</p>
                            </div>
                        </label>

                        @if ($file)
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-800">
                                    <i class="fas fa-file mr-2"></i>{{ $file->getClientOriginalName() }}
                                    <span class="text-gray-500">({{ number_format($file->getSize() / 1024, 2) }}
                                        KB)</span>
                                </p>
                            </div>
                        @endif

                        <div wire:loading wire:target="file" class="mt-4">
                            <p class="text-sm text-blue-600">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Mengupload file...
                            </p>
                        </div>
                    </div>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="/documents" wire:navigate
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition
                            disabled:opacity-50 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled" wire:target="update">
                        <span wire:loading.remove wire:target="update">
                            <i class="fas fa-save mr-2"></i>Update
                        </span>
                        <span wire:loading wire:target="update">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Mengupdate...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
