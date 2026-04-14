<div class="min-h-screen">
    <div class="mt-2">
        <!-- Header -->
        <div class="p-5 sm:p-7 rounded-3xl mb-4 bg-white dark:bg-zinc-900">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">

                {{-- LEFT: Title & Breadcrumb --}}
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 dark:text-white">
                        Tambah User Baru
                    </h1>

                    <nav class="flex flex-wrap items-center gap-2 text-sm">
                        <a href="/dashboard" wire:navigate class="text-gray-500 hover:text-gray-700 font-medium">
                            <i class="fas fa-home"></i>
                        </a>

                        <span class="text-gray-400">/</span>

                        <a href="/users" wire:navigate class="text-gray-500 hover:text-gray-700 font-medium">
                            Users
                        </a>

                        <span class="text-gray-400">/</span>

                        <span class="text-gray-900 font-medium dark:text-white">
                            Tambah Baru
                        </span>
                    </nav>
                </div>

                {{-- RIGHT: Button --}}
                <div class="w-full sm:w-auto">
                    <x-ui.button variant="primary" href="/users" wire:navigate class="w-full sm:w-auto justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </x-ui.button>
                </div>

            </div>
        </div>


        <!-- Form Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-3xl p-8 border border-gray-200 dark:border-zinc-700">
            <form wire:submit="save">
                <!-- Informasi User -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-user mr-2 text-blue-500"></i>Informasi User
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input label="Nama" model="name" required="true" placeholder="Masukan Nama Pegawai">
                            <x-slot name="icon">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-zinc-400 dark:text-zinc-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </x-slot>
                        </x-form.input>
                        <x-form.input label="Email" model="email" required="true" placeholder="email@gmail.com">
                            <x-slot name="icon">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-zinc-400 dark:text-zinc-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </x-slot>
                        </x-form.input>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-lock mr-2 text-green-500"></i>Password
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-password label="Password" model="password" required
                            helperText="Minimal 8 karakter" />

                        <x-form.input-password label="Konfirmasi Password" model="password_confirmation" required
                            helperText="Harus sama dengan password" />
                    </div>
                </div>

                <!-- Role Assignment -->
                <div class="mb-8">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b-2 border-gray-200 dark:border-zinc-700">
                        <i class="fas fa-user-shield mr-2 text-purple-500"></i>Role & Akses
                    </h3>

                    <div class="w-full">
                        <label class="block text-sm font-semibold text-zinc-900 dark:text-white mb-3">
                            Pilih Role <span class="text-red-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            @foreach ($roles as $role)
                                <label
                                    class="group relative flex cursor-pointer flex-col items-center gap-3 sm:gap-4 p-4 sm:p-5 lg:p-6 border-2 rounded-2xl sm:rounded-3xl transition-all duration-300 hover:shadow-md
                    {{ $role_id == $role->id
                        ? 'border-indigo-500 dark:border-white bg-indigo-50 dark:bg-white/10'
                        : 'border-zinc-200 dark:border-zinc-700 hover:border-zinc-300 dark:hover:border-zinc-600 bg-white dark:bg-zinc-900' }}">

                                    <input type="radio" wire:model.live="role_id" value="{{ $role->id }}"
                                        class="sr-only">

                                    <div
                                        class="w-14 h-14 sm:w-16 sm:h-16 lg:w-[70px] lg:h-[70px] flex shrink-0 items-center justify-center rounded-full transition-all duration-300
                        {{ $role->name === 'super_admin' ? 'bg-purple-100 dark:bg-white' : 'bg-green-100 dark:bg-white' }}">
                                        <svg class="w-7 h-7 sm:w-8 sm:h-8 lg:w-9 lg:h-9 {{ $role->name === 'super_admin' ? 'text-purple-600' : 'text-green-600' }}"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($role->name === 'super_admin')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            @endif
                                        </svg>
                                    </div>

                                    <div class="text-center space-y-1">
                                        <span
                                            class="text-sm sm:text-base font-semibold text-zinc-900 dark:text-white transition-colors block">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </span>
                                        <span
                                            class="px-2 py-0.5 text-xs font-semibold rounded-full inline-block
                            {{ $role->name === 'super_admin'
                                ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400'
                                : 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' }}">
                                            {{ $role->permissions->count() }} permissions
                                        </span>
                                        <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                            @if ($role->name === 'super_admin')
                                                Full akses ke seluruh sistem
                                            @else
                                                Akses terbatas
                                            @endif
                                        </p>
                                    </div>

                                    @if ($role_id == $role->id)
                                        <div
                                            class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-indigo-500 dark:bg-white p-1.5 rounded-full shadow-lg">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white dark:text-zinc-900"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    @endif
                                </label>
                            @endforeach
                        </div>

                        @error('role_id')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-2 flex items-center gap-1.5 ml-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <!-- Buttons -->
                <div
                    class="flex flex-col sm:flex-row justify-end items-center space-x-3 pt-6 border-t border-gray-200 dark:border-zinc-700">
                    <x-ui.button type="submit" loading="save" class="w-full sm:w-fit mb-3 sm:mb-0">
                        <i class="fas fa-save mr-2"></i>Simpan User
                    </x-ui.button>

                    <x-ui.button variant="secondary" href="/users" wire:navigate class="w-full sm:w-fit">
                        Batal
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
