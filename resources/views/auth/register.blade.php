<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black tracking-tighter text-on-surface mb-2">Create Account</h1>
            <p class="text-tertiary font-medium">Start your journey into computer science today.</p>
        </div>

        <div class="bg-surface-container-low p-8 rounded-[2.5rem] border border-surface-container-high shadow-2xl shadow-primary/5">
            <!-- Error Alert -->
            @if ($errors->any())
                <div class="mb-6 px-4 py-3 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm font-semibold flex items-start gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Full Name</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Budi Santoso"
                            required
                            autofocus
                            autocomplete="name"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('name') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@contoh.com"
                            required
                            autocomplete="username"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('email') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Min. 8 karakter"
                            required
                            autocomplete="new-password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('password') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Confirm Password</label>
                    <div class="relative">
                        <i data-lucide="shield-check" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            required
                            autocomplete="new-password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- Terms -->
                <div class="text-xs text-tertiary font-medium px-1 pt-1">
                    By signing up, you agree to our <a href="#" class="text-primary font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-primary font-bold hover:underline">Privacy Policy</a>.
                </div>

                <!-- Submit -->
                <button
                    id="btn-register-submit"
                    type="submit"
                    class="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2"
                >
                    Create Account <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-sm font-medium text-tertiary">
            Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Sign In</a>
        </p>
    </div>
</x-guest-layout>
