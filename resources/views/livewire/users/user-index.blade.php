<div class="min-h-screen">
    <div class="container mx-auto lg:p-4">
        <!-- Header Section - Improved Responsive -->
        <div class="mb-4 sm:mb-6 transition-colors duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <div class="p-3 sm:p-5 bg-emerald-600 dark:bg-white rounded-full shadow-lg flex-shrink-0">
                            <flux:icon.user-plus variant="outline"
                                class="w-5 h-5 sm:w-6 sm:h-6 text-white dark:text-zinc-800" />
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
                                Management Role
                            </h1>
                            <p
                                class="text-gray-600 dark:text-gray-400 font-medium text-xs sm:text-sm lg:text-base mt-1">
                                Kelola dan organisir role akses pengguna
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Action Button -->
                <div class="flex items-center gap-3">
                    @can('users.create')
                        <a href="{{ route('users.create') }}" wire:navigate
                            class="flex items-center justify-center space-x-2 px-4 sm:px-5 py-2.5 sm:py-3 w-full sm:w-auto font-semibold bg-emerald-700 hover:bg-emerald-800 dark:bg-white dark:hover:bg-gray-100 text-white dark:text-gray-900 rounded-full transition shadow-md hover:shadow-lg text-sm sm:text-base">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah User</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Filters - Improved Grid -->
        <x-filter.card title="Filter & Pencarian">
            <div class="col-span-2 sm:col-span-1">
                <x-filter.search model="search" label="Pencarian" placeholder="Cari user..." />
            </div>
            <div class="col-span-2 sm:col-span-1">
                <x-filter.select label="Role" model="roleFilter">
                    <option value="">Semua Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst(str_replace('_', ' ', $role->name)) }}</option>
                    @endforeach
                </x-filter.select>
            </div>
            <div class="col-span-2">
                <x-filter.reset />
            </div>
        </x-filter.card>

        <!-- Table - Mobile Responsive -->
        <div
            class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-2xl overflow-hidden mt-6">
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                User
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Email
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Role
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Dokumen
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Status Login
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($user->profile_photo)
                                            <img src="{{ Storage::url($user->profile_photo) }}"
                                                alt="{{ $user->name }}"
                                                class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-200 dark:ring-zinc-700 flex-shrink-0">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-500 text-white font-semibold ring-2 ring-gray-200 dark:ring-zinc-700 flex-shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                                {{ $user->name }}
                                                @if ($user->id === auth()->id())
                                                    <span
                                                        class="ml-2 px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs rounded-full">
                                                        You
                                                    </span>
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Joined {{ $user->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700 dark:text-gray-300 truncate">{{ $user->email }}</p>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-flex px-3 py-1.5 text-xs font-bold rounded-lg whitespace-nowrap
                                            {{ $role->name === 'super_admin'
                                                ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400'
                                                : 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' }}">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-semibold">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        {{ $user->documents_count }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($user->isOnline())
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 whitespace-nowrap">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                            Online
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 whitespace-nowrap">
                                            <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                                            {{ $user->getFormattedLastSeen() }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-3 py-1.5 text-xs font-bold rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 whitespace-nowrap">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Active
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @can('users.edit')
                                            <x-ui.action-button variant="edit" icon="pencil" title="Edit"
                                                href="/users/{{ $user->id }}/edit" wire:navigate />
                                        @endcan

                                        @can('users.delete')
                                            @if ($user->id !== auth()->id())
                                                <x-ui.action-button variant="delete" icon="trash" title="Hapus"
                                                    wire:click="$dispatch('delete-confirm', { id: {{ $user->id }} })" />
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-users text-5xl mb-4"></i>
                                        <p class="text-lg font-bold mb-2">Tidak ada user ditemukan</p>
                                        <p class="text-sm">Ubah filter atau tambah user baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile & Tablet Card View -->
            <div class="lg:hidden divide-y divide-gray-200 dark:divide-zinc-800">
                @forelse ($users as $user)
                    <div class="p-4 sm:p-6 hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition">
                        <!-- User Info -->
                        <div class="flex items-start gap-3 mb-4">
                            @if ($user->profile_photo)
                                <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}"
                                    class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover ring-2 ring-gray-200 dark:ring-zinc-700 flex-shrink-0">
                            @else
                                <div
                                    class="w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center bg-emerald-500 text-white font-semibold ring-2 ring-gray-200 dark:ring-zinc-700 flex-shrink-0 text-lg sm:text-xl">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white truncate">
                                        {{ $user->name }}
                                    </h3>
                                    @if ($user->id === auth()->id())
                                        <span
                                            class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs rounded-full flex-shrink-0">
                                            You
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 truncate mb-1">{{ $user->email }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Joined {{ $user->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- User Details Grid -->
                        <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-4">
                            <!-- Role -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase">Role
                                </p>
                                @foreach ($user->roles as $role)
                                    <span
                                        class="inline-flex px-2.5 py-1 text-xs font-bold rounded-lg
                                        {{ $role->name === 'super_admin'
                                            ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400'
                                            : 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' }}">
                                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Documents -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase">
                                    Dokumen</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-1 bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-file-alt mr-1.5"></i>
                                    {{ $user->documents_count }}
                                </span>
                            </div>

                            <!-- Status Login -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase">
                                    Status Login</p>
                                @if ($user->isOnline())
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                        <span
                                            class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                                        Online
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span>
                                        <span class="truncate">{{ $user->getFormattedLastSeen() }}</span>
                                    </span>
                                @endif
                            </div>

                            <!-- Status -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5 uppercase">
                                    Status</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Active
                                </span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 pt-3 border-t border-gray-200 dark:border-zinc-700">
                            @can('users.edit')
                                <a href="/users/{{ $user->id }}/edit" wire:navigate
                                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition text-sm font-semibold">
                                    <i class="fas fa-pencil"></i>
                                    <span>Edit</span>
                                </a>
                            @endcan

                            @can('users.delete')
                                @if ($user->id !== auth()->id())
                                    <button wire:click="$dispatch('delete-confirm', { id: {{ $user->id }} })"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition text-sm font-semibold">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                @endif
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-16">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <i class="fas fa-users text-4xl sm:text-5xl mb-4"></i>
                            <p class="text-base sm:text-lg font-bold mb-2">Tidak ada user ditemukan</p>
                            <p class="text-sm">Ubah filter atau tambah user baru</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-zinc-800">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('delete-confirm', (event) => {
                if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                    Livewire.dispatch('delete-user', {
                        id: event.id
                    });
                }
            });
        });
    </script>
</div>
