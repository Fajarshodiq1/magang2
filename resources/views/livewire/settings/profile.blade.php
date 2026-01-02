<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="space-y-5">
            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-semibold text-[#0A090B] dark:text-white mb-2">
                    {{ __('Name') }}
                </label>
                <input wire:model="name" type="text" id="name" required autofocus autocomplete="name"
                    class="w-full h-[52px] px-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-900 text-[#0A090B] dark:text-white font-semibold placeholder:text-[#7F8190] placeholder:font-normal outline-none focus:border-[#2B82FE] focus:ring-2 focus:ring-[#2B82FE]/20 transition-all"
                    placeholder="Enter your name" />
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#0A090B] dark:text-white mb-2">
                    {{ __('Email') }}
                </label>
                <input wire:model="email" type="email" id="email" required autocomplete="email"
                    class="w-full h-[52px] px-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-900 text-[#0A090B] dark:text-white font-semibold placeholder:text-[#7F8190] placeholder:font-normal outline-none focus:border-[#2B82FE] focus:ring-2 focus:ring-[#2B82FE]/20 transition-all"
                    placeholder="Enter your email" />
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div
                        class="mt-4 p-4 rounded-xl bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            {{ __('Your email address is unverified.') }}
                            <button type="button" wire:click.prevent="resendVerificationNotification"
                                class="font-semibold underline hover:text-yellow-900 dark:hover:text-yellow-100 transition-colors">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-semibold text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Profile Photo Upload -->
            <div>
                <label for="profile_photo" class="block text-sm font-semibold text-[#0A090B] dark:text-white mb-2">
                    {{ __('Profile Photo') }}
                </label>
                <div class="flex items-center gap-4">
                    <!-- Preview -->
                    <div
                        class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center">
                        @if ($profile_photo)
                            <img src="{{ $profile_photo->temporaryUrl() }}" class="w-full h-full object-cover" />
                        @else
                            <span class="text-black dark:text-white text-xl font-bold">
                                {{ auth()->user()->initials() }}
                            </span>
                        @endif
                    </div>
                    <!-- File Input -->
                    <label class="flex-1">
                        <input wire:model="profile_photo" type="file" id="profile_photo" accept="image/*"
                            autocomplete="profile_photo" class="hidden" />
                        <div
                            class="w-full h-[52px] px-4 rounded-full border border-[#EEEEEE] dark:border-zinc-700 bg-white dark:bg-zinc-900 flex items-center cursor-pointer hover:border-[#2B82FE] transition-all">
                            <span class="text-sm text-[#7F8190] dark:text-zinc-400">
                                {{ __('Choose file or drag and drop') }}
                            </span>
                        </div>
                    </label>
                </div>
                @error('profile_photo')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-8 h-[52px] rounded-full bg-[#2B82FE] hover:bg-[#2570dc] text-white font-semibold transition-all duration-300 focus:ring-4 focus:ring-[#2B82FE]/20 outline-none">
                    {{ __('Save Changes') }}
                </button>

                <div x-data="{ show: false }" x-show="show" x-transition x-init="@this.on('profile-updated', () => {
                    show = true;
                    setTimeout(() => show = false, 2000)
                })"
                    class="text-sm font-semibold text-green-600 dark:text-green-400">
                    {{ __('Saved successfully!') }}
                </div>
            </div>
        </form>
        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
<script>
    // Handle file input display
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('profile_photo');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if (fileName) {
                    const label = this.parentElement.querySelector('span');
                    if (label) {
                        label.textContent = fileName;
                        label.classList.remove('text-[#7F8190]', 'dark:text-zinc-400');
                        label.classList.add('text-[#0A090B]', 'dark:text-white', 'font-semibold');
                    }
                }
            });
        }
    });
</script>
