<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-5">
                <i data-lucide="lock-keyhole" class="w-8 h-8 text-primary"></i>
            </div>
            <h1 class="text-4xl font-black tracking-tighter text-on-surface mb-2">Reset Password</h1>
            <p class="text-tertiary font-medium">Enter your new password below.</p>
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

            <form class="space-y-5" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token (hidden) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $request->email) }}"
                            placeholder="nama@contoh.com"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('email') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">New Password</label>
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
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Confirm New Password</label>
                    <div class="relative">
                        <i data-lucide="shield-check" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            required
                            autocomplete="new-password"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-transparent' }} focus:border-primary outline-none transition-all font-medium"
                        />
                    </div>
                </div>

                <button
                    id="btn-reset-submit"
                    type="submit"
                    class="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2"
                >
                    Reset Password <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
