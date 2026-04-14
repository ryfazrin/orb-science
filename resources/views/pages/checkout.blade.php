@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-black tracking-tighter text-on-surface mb-4">Secure Checkout</h1>
        <p class="text-lg text-tertiary">Complete your enrollment to unlock the course materials instantly.</p>
    </div>

    <div class="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high mb-8 shadow-xl">
        <!-- Order Summary -->
        <h2 class="text-2xl font-black tracking-tight text-on-surface mb-6 flex items-center gap-3">
            <i data-lucide="shopping-cart" class="w-6 h-6 text-primary"></i> Order Summary
        </h2>
        
        <div class="flex items-center gap-6 mb-8 p-6 bg-surface-container-lowest rounded-2xl border border-surface-container-high">
            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0">
                <img src="{{ $course->thumbnail_url ?? 'https://picsum.photos/seed/'.$course->id.'/400/300' }}" alt="{{ $course->title }}" class="w-full h-full object-cover" referrerpolicy="no-referrer" />
            </div>
            <div>
                <span class="px-2 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest shadow-sm mb-2 inline-block">
                    {{ $course->category ?? 'Course' }}
                </span>
                <h3 class="text-lg font-black leading-tight text-on-surface mb-1">{{ $course->title }}</h3>
                <p class="text-sm font-bold text-tertiary">By {{ $course->instructor->user->name ?? 'Instructor' }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-8">
            <div class="flex justify-between items-center text-tertiary font-bold">
                <span>Original Price</span>
                <span>Rp {{ number_format($course->price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center text-green-600 font-bold">
                <span>Discount</span>
                <span>- Rp 0</span>
            </div>
            <div class="border-t border-surface-container-high pt-4 mt-4 flex justify-between items-center">
                <span class="text-xl font-black text-on-surface">Total Due</span>
                <span class="text-3xl font-black text-primary">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Fake Payment Simulation -->
        <h2 class="text-xl font-black tracking-tight text-on-surface mb-4 flex items-center gap-3">
            <i data-lucide="credit-card" class="w-5 h-5 text-primary"></i> Payment Details
        </h2>
        <div class="p-6 bg-yellow-500/10 border border-yellow-500/20 rounded-2xl mb-8 flex gap-4 items-start">
            <i data-lucide="info" class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5"></i>
            <p class="text-sm font-medium text-yellow-700 leading-relaxed">
                <strong>Simulated Payment:</strong> No real payment is required. Clicking the button below will instantly enroll you as the Demo Student and redirect you to your dashboard.
            </p>
        </div>

        <form action="/checkout/{{ $course->id }}/process" method="POST">
            @csrf
            <button type="submit" class="w-full py-5 bg-primary text-white rounded-full font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                Pay Rp {{ number_format($course->price, 0, ',', '.') }} & Enroll
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
        </form>
    </div>
    
    <div class="text-center text-tertiary text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
        <i data-lucide="lock" class="w-4 h-4"></i> Secure SSL Encrypted Checkout
    </div>
</div>
@endsection
