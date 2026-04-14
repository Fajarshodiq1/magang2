<x-layouts.auth>
    <div x-data="{ showPassword: false }" class="relative min-h-screen flex items-center justify-center">

        {{-- ============================================================
             BACKGROUND LAYER
        ============================================================ --}}
        <div class="pointer-events-none fixed inset-0 -z-20 overflow-hidden">
            {{-- Ganti src dengan asset lokal: asset('assets/bg-login.jpg') --}}
            <img src="{{ asset('asset/banner.jpg') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover object-center" />
            {{-- Dark green overlay --}}
            <div class="absolute inset-0 bg-gradient-to-br from-green-950/85 via-emerald-900/70 to-green-950/85"></div>
            {{-- Noise texture --}}
            <div class="absolute inset-0 opacity-[0.03]"
                style="background-image:url('data:image/svg+xml,%3Csvg viewBox=\'0 0 256 256\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'n\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.9\' numOctaves=\'4\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23n)\'/%3E%3C/svg%3E');">
            </div>
        </div>

        {{-- ============================================================
             DECORATIVE GLOWING BLOBS
        ============================================================ --}}
        <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div
                class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-green-500/20 blur-[120px] animate-pulse">
            </div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full bg-emerald-400/15 blur-[100px] animate-pulse"
                style="animation-delay:1.5s"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-green-600/10 blur-[140px]">
            </div>
        </div>

        {{-- ============================================================
             MAIN CONTAINER
        ============================================================ --}}
        <div class="relative flex flex-col gap-5 w-full max-w-sm mx-auto px-4 sm:px-0 py-6">

            {{-- ── Logo + Branding ── --}}
            <div class="flex flex-col items-center gap-3 pb-2">
                <div class="relative">
                    <div class="absolute inset-0 bg-green-400/30 blur-2xl rounded-full scale-125 animate-pulse"></div>
                    <div
                        class="relative w-20 h-20 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-xl shadow-green-500/20">
                        <img src="{{ asset('asset/kemenag.png') }}" alt="Logo" class="h-12 w-auto drop-shadow-lg" />
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold tracking-tight text-white drop-shadow">
                        Kementerian Agama
                    </h1>
                    <p class="text-xs text-green-300/80 mt-0.5 tracking-widest uppercase font-medium">Kearsipan Dokumen
                    </p>
                </div>
            </div>

            {{-- ── Glassmorphism Card ── --}}
            <div
                class="relative bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl shadow-black/40 border border-white/20 overflow-hidden">

                {{-- Gradient top strip --}}
                <div class="h-1 w-full bg-gradient-to-r from-green-400 via-emerald-400 to-green-500"></div>

                {{-- Inner shimmer highlight --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div
                        class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-b from-white/10 to-transparent rounded-t-3xl">
                    </div>
                </div>

                <div class="p-6 sm:p-7 flex flex-col gap-5 relative">

                    <div>
                        <h2 class="text-base font-bold text-white">Selamat datang</h2>
                        <p class="text-xs text-white/50 mt-0.5">Masuk ke panel administrator</p>
                    </div>

                    <x-auth-session-status class="text-center text-xs text-green-300" :status="session('status')" />

                    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
                        @csrf

                        {{-- Email --}}
                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-xs font-semibold text-white/70 uppercase tracking-wide">
                                Email
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </span>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="email" placeholder="email@example.com"
                                    class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl
                                           bg-white/10 backdrop-blur-sm border border-white/20
                                           text-white placeholder:text-white/30
                                           focus:outline-none focus:ring-2 focus:ring-green-400/60 focus:border-green-400/40
                                           transition-all duration-200" />
                            </div>
                            @error('email')
                                <p class="text-xs text-red-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="text-xs font-semibold text-white/70 uppercase tracking-wide">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs text-green-400 hover:text-green-300 font-medium transition-colors">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                    required autocomplete="current-password" placeholder="••••••••"
                                    class="w-full pl-10 pr-11 py-2.5 text-sm rounded-xl
                                           bg-white/10 backdrop-blur-sm border border-white/20
                                           text-white placeholder:text-white/30
                                           focus:outline-none focus:ring-2 focus:ring-green-400/60 focus:border-green-400/40
                                           transition-all duration-200" />
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-white/40 hover:text-green-400 transition-colors">
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="display:none">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs text-red-400 flex items-center gap-1">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <label class="flex items-center gap-2.5 cursor-pointer select-none group">
                            <div class="relative">
                                <input id="remember" name="remember" type="checkbox"
                                    {{ old('remember') ? 'checked' : '' }} class="sr-only peer" />
                                <div
                                    class="w-8 h-4 rounded-full bg-white/20 peer-checked:bg-green-500 transition-colors duration-200">
                                </div>
                                <div
                                    class="absolute top-0.5 left-0.5 w-3 h-3 rounded-full bg-white shadow transition-transform duration-200 peer-checked:translate-x-4">
                                </div>
                            </div>
                            <span class="text-xs text-white/60 group-hover:text-white/90 transition-colors">
                                Ingat saya
                            </span>
                        </label>

                        {{-- Submit --}}
                        <button type="submit"
                            class="relative w-full py-2.5 rounded-xl
                                   bg-gradient-to-r from-green-600 to-emerald-500
                                   hover:from-green-500 hover:to-emerald-400
                                   active:scale-[0.98]
                                   text-white text-sm font-bold tracking-wide
                                   shadow-lg shadow-green-700/40
                                   hover:shadow-xl hover:shadow-green-500/40
                                   focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 focus:ring-offset-transparent
                                   transition-all duration-150 overflow-hidden group">
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent
                                        -translate-x-full group-hover:translate-x-full transition-transform duration-500"></span>
                            <span class="relative">Masuk</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
