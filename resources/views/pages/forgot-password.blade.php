@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12" x-data="{ isSubmitted: false }">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black tracking-tighter text-on-surface mb-2" x-text="isSubmitted ? 'Check Your Email' : 'Reset Password'"></h1>
            <p class="text-tertiary font-medium" x-text="isSubmitted ? 'We\'ve sent password reset instructions to your email address.' : 'Enter your email and we\'ll send you a link to reset your password.'"></p>
        </div>

        <div class="bg-surface-container-lowest p-8 rounded-[2.5rem] border border-surface-container-high shadow-2xl shadow-primary/5">
            <div x-show="!isSubmitted">
                <form class="space-y-6" @submit.prevent="isSubmitted = true">
                    @csrf
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Email Address</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-[18px] h-[18px]"></i>
                            <input 
                                type="email" 
                                required
                                name="email"
                                placeholder="name@example.com" 
                                class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-low border border-transparent focus:border-primary outline-none transition-all font-medium"
                            />
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        Send Reset Link <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>

            <div x-show="isSubmitted" style="display: none;" class="text-center py-4">
                <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="check-circle-2" class="w-10 h-10"></i>
                </div>
                <p class="text-on-surface font-medium mb-8">
                    Didn't receive the email? Check your spam folder or try again.
                </p>
                <button 
                    @click="isSubmitted = false"
                    class="w-full py-4 rounded-2xl bg-surface-container-low text-on-surface font-black text-lg hover:bg-surface-container-high transition-all"
                >
                    Try Another Email
                </button>
            </div>

            <div class="mt-8 pt-8 border-t border-surface-container-high text-center">
                <a 
                    href="/login"
                    class="inline-flex items-center gap-2 text-primary font-bold hover:underline"
                >
                    <i data-lucide="arrow-left" class="w-[18px] h-[18px]"></i> Back to Sign In
                </a>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
