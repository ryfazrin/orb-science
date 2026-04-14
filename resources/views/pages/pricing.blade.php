@extends('layouts.app')

@section('content')
<div class="pt-12 pb-24 px-6 md:px-8 max-w-7xl mx-auto overflow-hidden">
    <!-- Hero Section -->
    <div class="text-center mb-32 space-y-6">
        <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-on-surface leading-[0.9]">
            Knowledge that <span class="text-primary italic">sticks.</span>
        </h1>
        <p class="text-xl md:text-2xl text-tertiary max-w-2xl mx-auto font-medium leading-relaxed">
            Choose a plan that fits your learning journey. Empowering non-tech minds with crystal-clear digital wisdom.
        </p>
    </div>

    <!-- Pricing Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-end mb-40">
        <!-- Monthly Plan -->
        <div class="bg-surface-container-low p-12 rounded-[3rem] space-y-10 flex flex-col h-full hover:scale-[1.02] transition-transform duration-500 border border-surface-container-high">
            <div class="space-y-3">
                <h3 class="text-3xl font-black tracking-tight">Monthly</h3>
                <p class="text-tertiary font-medium">Flexible access to everything.</p>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-5xl font-black tracking-tighter">$29</span>
                <span class="text-tertiary font-black uppercase tracking-widest text-xs">/mo</span>
            </div>
            <ul class="space-y-5 flex-grow">
                @foreach(['Unlimited Course Access', 'Community Forum Access', 'Weekly Newsletter'] as $feature)
                <li class="flex items-center gap-4">
                    <i data-lucide="check-circle" class="text-primary w-5 h-5"></i>
                    <span class="text-sm font-bold text-on-surface">{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
            <a 
                href="/register"
                class="block text-center w-full py-5 px-8 rounded-full font-black text-on-surface border-2 border-on-surface/10 hover:bg-on-surface/5 transition-all uppercase tracking-widest text-xs"
            >
                Start Monthly
            </a>
        </div>

        <!-- Yearly Plan (Best Value) -->
        <div class="relative bg-surface-container-lowest p-12 rounded-[3rem] shadow-[0px_40px_80px_rgba(188,1,0,0.15)] border-2 border-primary/20 space-y-10 flex flex-col h-[110%] scale-105 z-10 hover:scale-[1.07] transition-transform duration-500">
            <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-primary text-white px-8 py-2 rounded-full text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-primary/20">
                Best Value
            </div>
            <div class="space-y-3">
                <h3 class="text-3xl font-black tracking-tight">Yearly</h3>
                <p class="text-tertiary font-medium">Our most popular learning path.</p>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-7xl font-black tracking-tighter">$249</span>
                <span class="text-tertiary font-black uppercase tracking-widest text-xs">/yr</span>
            </div>
            <ul class="space-y-5 flex-grow">
                @foreach(['Everything in Monthly', 'Offline Video Downloads', 'Exclusive Webinars', 'Priority Support'] as $feature)
                <li class="flex items-center gap-4">
                    <i data-lucide="shield-check" class="text-primary w-6 h-6 fill-current opacity-10"></i>
                    <span class="text-base font-black text-on-surface">{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
            <a 
                href="/register"
                class="block text-center w-full py-6 px-8 rounded-full font-black text-white bg-primary hover:opacity-90 active:scale-95 transition-all shadow-2xl shadow-primary/30 uppercase tracking-widest text-sm"
            >
                Get Yearly Access
            </a>
        </div>

        <!-- Lifetime Access -->
        <div class="bg-surface-container-low p-12 rounded-[3rem] space-y-10 flex flex-col h-full hover:scale-[1.02] transition-transform duration-500 border border-surface-container-high">
            <div class="space-y-3">
                <h3 class="text-3xl font-black tracking-tight">Lifetime Access</h3>
                <p class="text-tertiary font-medium">One payment, forever wisdom.</p>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-5xl font-black tracking-tighter">$599</span>
                <span class="text-tertiary font-black uppercase tracking-widest text-xs">once</span>
            </div>
            <ul class="space-y-5 flex-grow">
                @foreach(['Lifetime Course Access', 'All Future Courses Included', 'Private Discord Access'] as $feature)
                <li class="flex items-center gap-4">
                    <i data-lucide="infinity" class="text-primary w-5 h-5"></i>
                    <span class="text-sm font-bold text-on-surface">{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
            <a 
                href="/register"
                class="block text-center w-full py-5 px-8 rounded-full font-black text-on-surface border-2 border-on-surface/10 hover:bg-on-surface/5 transition-all uppercase tracking-widest text-xs"
            >
                Join Lifetime
            </a>
        </div>
    </div>

    <!-- Bento FAQ Section -->
    <div class="mt-60 space-y-16">
        <div class="text-center space-y-4">
            <h2 class="text-5xl font-black tracking-tighter">Payment FAQ</h2>
            <p class="text-xl text-tertiary font-medium">Everything you need to know about your investment.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-8 bg-surface-container-low p-12 rounded-[2.5rem] border border-surface-container-high">
                <div class="flex gap-6">
                    <i data-lucide="credit-card" class="text-primary flex-shrink-0 w-8 h-8"></i>
                    <div class="space-y-4">
                        <h4 class="text-2xl font-black tracking-tight">What payment methods do you accept?</h4>
                        <p class="text-tertiary font-medium leading-relaxed text-lg">
                            We accept all major credit cards including Visa, Mastercard, and American Express. Additionally, we support PayPal and Apple Pay for a seamless checkout experience. All transactions are encrypted and processed through industry-standard secure gateways.
                        </p>
                    </div>
                </div>
            </div>
            <div class="md:col-span-4 bg-primary text-white p-12 rounded-[2.5rem] flex flex-col justify-between shadow-2xl shadow-primary/20">
                <h4 class="text-2xl font-black tracking-tight">Safe & Secure</h4>
                <p class="text-base font-medium opacity-90 leading-relaxed">Your data is protected by 256-bit SSL encryption. We never store your full credit card details.</p>
                <i data-lucide="lock" class="opacity-20 self-end w-12 h-12"></i>
            </div>
            <div class="md:col-span-6 bg-surface-container-high p-10 rounded-[2.5rem]">
                <div class="flex gap-6">
                    <i data-lucide="refresh-ccw" class="text-primary flex-shrink-0 w-6 h-6"></i>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black tracking-tight">Can I cancel anytime?</h4>
                        <p class="text-tertiary font-medium leading-relaxed">Yes, absolutely. You can cancel your Monthly or Yearly subscription at any time from your account settings with just two clicks. You'll keep access until the end of your billing cycle.</p>
                    </div>
                </div>
            </div>
            <div class="md:col-span-6 bg-surface-container-high p-10 rounded-[2.5rem]">
                <div class="flex gap-6">
                    <i data-lucide="dollar-sign" class="text-primary flex-shrink-0 w-6 h-6"></i>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black tracking-tight">Do you offer refunds?</h4>
                        <p class="text-tertiary font-medium leading-relaxed">We provide a 14-day no-questions-asked money-back guarantee. If Ilmu Komputer isn't the right fit for you, just email us and we'll process your refund immediately.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Section -->
    <div class="mt-40 p-16 bg-surface-container-lowest rounded-[3rem] text-center space-y-12 border border-surface-container-high">
        <h4 class="text-tertiary font-black uppercase tracking-[0.3em] text-xs">Trusted by learners from</h4>
        <div class="flex flex-wrap justify-center gap-16 opacity-30 grayscale contrast-125">
            @foreach(['Google', 'Meta', 'Amazon', 'Stripe', 'Notion'] as $brand)
            <span class="text-3xl font-black tracking-tighter">{{ $brand }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
