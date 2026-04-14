<!-- Filter Dropdown Component -->
<div x-data="{
    openFilter: null,
    activeFilters: @entangle('activeFilterCount').live,
    toggleFilter(filter) {
        this.openFilter = this.openFilter === filter ? null : filter;
    },
    closeAll() {
        this.openFilter = null;
    }
}" @click.away="closeAll()" class="relative">

    <!-- Filter Bar -->
    <div class="bg-white dark:bg-zinc-900 rounded-2xl p-4 sm:p-6 mb-6 border border-gray-200 dark:border-zinc-800">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <!-- Search Box -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari dokumen..."
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-zinc-700 rounded-full bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    @if ($search)
                        <button wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2 flex-wrap">

                <!-- File Type Filter -->
                <div class="relative">
                    <button @click="toggleFilter('fileType')"
                        :class="openFilter === 'fileType' ? 'ring-2 ring-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : ''"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Tipe File
                        @if ($fileType)
                            <span
                                class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-emerald-600 rounded-full">1</span>
                        @endif
                        <svg class="w-4 h-4 transition-transform" :class="openFilter === 'fileType' ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="openFilter === 'fileType'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 z-50"
                        style="display: none;">
                        <div class="p-2">
                            <button wire:click="$set('fileType', '')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $fileType }}'
                                === '' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <span>Semua Tipe</span>
                                    @if (!$fileType)
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <button wire:click="$set('fileType', 'pdf')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $fileType }}'
                                === 'pdf' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">PDF</span>
                                        PDF Files
                                    </div>
                                    @if ($fileType === 'pdf')
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <button wire:click="$set('fileType', 'doc')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $fileType }}'
                                === 'doc' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">DOC</span>
                                        Word Documents
                                    </div>
                                    @if ($fileType === 'doc')
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <button wire:click="$set('fileType', 'docx')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $fileType }}'
                                === 'docx' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">DOCX</span>
                                        Word Documents (New)
                                    </div>
                                    @if ($fileType === 'docx')
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="relative">
                    <button @click="toggleFilter('category')"
                        :class="openFilter === 'category' ? 'ring-2 ring-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : ''"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Kategori
                        @if ($categoryFilter)
                            <span
                                class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-emerald-600 rounded-full">1</span>
                        @endif
                        <svg class="w-4 h-4 transition-transform"
                            :class="openFilter === 'category' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openFilter === 'category'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 z-50 max-h-80 overflow-y-auto"
                        style="display: none;">
                        <div class="p-2">
                            <button wire:click="$set('categoryFilter', '')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $categoryFilter }}'
                                === '' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <span>Semua Kategori</span>
                                    @if (!$categoryFilter)
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <div class="border-t border-gray-200 dark:border-zinc-700 my-1"></div>
                            @foreach ($categories as $category)
                                <button wire:click="$set('categoryFilter', '{{ $category->id }}')" @click="closeAll()"
                                    class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                    :class="'{{ $categoryFilter }}'
                                    === '{{ $category->id }}' ?
                                        'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                        'text-gray-700 dark:text-gray-300'">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $category->name }}</span>
                                        @if ($categoryFilter == $category->id)
                                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Year Filter -->
                <div class="relative">
                    <button @click="toggleFilter('year')"
                        :class="openFilter === 'year' ? 'ring-2 ring-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : ''"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Tahun
                        @if ($yearFilter)
                            <span
                                class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-emerald-600 rounded-full">1</span>
                        @endif
                        <svg class="w-4 h-4 transition-transform"
                            :class="openFilter === 'year' ? 'rotate-180' : ''" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openFilter === 'year'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 z-50 max-h-80 overflow-y-auto"
                        style="display: none;">
                        <div class="p-2">
                            <button wire:click="$set('yearFilter', '')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $yearFilter }}'
                                === '' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <span>Semua Tahun</span>
                                    @if (!$yearFilter)
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <div class="border-t border-gray-200 dark:border-zinc-700 my-1"></div>
                            @foreach ($years as $year)
                                <button wire:click="$set('yearFilter', '{{ $year }}')" @click="closeAll()"
                                    class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                    :class="'{{ $yearFilter }}'
                                    === '{{ $year }}' ?
                                        'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                        'text-gray-700 dark:text-gray-300'">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $year }}</span>
                                        @if ($yearFilter == $year)
                                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Archive Category Filter -->
                <div class="relative">
                    <button @click="toggleFilter('archive')"
                        :class="openFilter === 'archive' ? 'ring-2 ring-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : ''"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        Klasifikasi
                        @if ($archiveCategoryFilter)
                            <span
                                class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-emerald-600 rounded-full">1</span>
                        @endif
                        <svg class="w-4 h-4 transition-transform"
                            :class="openFilter === 'archive' ? 'rotate-180' : ''" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openFilter === 'archive'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-80 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 z-50 max-h-80 overflow-y-auto"
                        style="display: none;">
                        <div class="p-2">
                            <button wire:click="$set('archiveCategoryFilter', '')" @click="closeAll()"
                                class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                :class="'{{ $archiveCategoryFilter }}'
                                === '' ?
                                    'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                    'text-gray-700 dark:text-gray-300'">
                                <div class="flex items-center justify-between">
                                    <span>Semua Klasifikasi</span>
                                    @if (!$archiveCategoryFilter)
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </button>
                            <div class="border-t border-gray-200 dark:border-zinc-700 my-1"></div>
                            @foreach ($archiveCategories as $code => $name)
                                <button wire:click="$set('archiveCategoryFilter', '{{ $code }}')"
                                    @click="closeAll()"
                                    class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition"
                                    :class="'{{ $archiveCategoryFilter }}'
                                    === '{{ $code }}' ?
                                        'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-semibold' :
                                        'text-gray-700 dark:text-gray-300'">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">{{ $code }}</span>
                                            <span class="text-xs">{{ Str::limit($name, 30) }}</span>
                                        </div>
                                        @if ($archiveCategoryFilter === $code)
                                            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reset Filters Button -->
                @if ($search || $fileType || $categoryFilter || $yearFilter || $archiveCategoryFilter)
                    <button wire:click="resetFilters"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </button>
                @endif
            </div>
        </div>

        <!-- Active Filters Display -->
        @if ($search || $fileType || $categoryFilter || $yearFilter || $archiveCategoryFilter)
            <div class="mt-4 flex items-center gap-2 flex-wrap">
                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Filter Aktif:</span>

                @if ($search)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        "{{ $search }}"
                        <button wire:click="$set('search', '')"
                            class="hover:text-emerald-900 dark:hover:text-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if ($fileType)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-medium">
                        Tipe: {{ strtoupper($fileType) }}
                        <button wire:click="$set('fileType', '')"
                            class="hover:text-emerald-900 dark:hover:text-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if ($categoryFilter)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-medium">
                        Kategori: {{ $categories->find($categoryFilter)?->name }}
                        <button wire:click="$set('categoryFilter', '')"
                            class="hover:text-emerald-900 dark:hover:text-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if ($yearFilter)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-medium">
                        Tahun: {{ $yearFilter }}
                        <button wire:click="$set('yearFilter', '')"
                            class="hover:text-emerald-900 dark:hover:text-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif

                @if ($archiveCategoryFilter)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-medium">
                        Klasifikasi: {{ $archiveCategoryFilter }}
                        <button wire:click="$set('archiveCategoryFilter', '')"
                            class="hover:text-emerald-900 dark:hover:text-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                @endif
            </div>
        @endif
    </div>
</div>
