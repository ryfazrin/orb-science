<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black tracking-tighter text-on-surface mb-2">Welcome Back</h1>
            <p class="text-tertiary font-medium">Continue your journey into computer science.</p>
        </div>

        <div class="bg-surface-container-low p-8 rounded-[2.5rem] border border-surface-container-high shadow-2xl shadow-primary/5">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 px-4 py-3 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                    {{ session('status') }}
                </div>
            @endif

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

            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

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
                            autofocus
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
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('password') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-surface-container-high accent-primary"
                        />
                        <span class="text-tertiary font-bold group-hover:text-on-surface transition-colors">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-primary font-bold hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button
                    id="btn-login-submit"
                    type="submit"
                    class="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2"
                >
                    Sign In <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-sm font-medium text-tertiary">
            Don't have an account? <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Create one for free</a>
        </p>
    </div>
</x-guest-layout>
