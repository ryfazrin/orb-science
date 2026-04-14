@extends('layouts.app')

@section('content')
<div class="flex flex-col">
    <!-- Hero Section -->
    <section class="relative h-[80vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
                src="https://picsum.photos/seed/tech/1920/1080" 
                alt="Hero Background" 
                class="w-full h-full object-cover opacity-20"
                referrerpolicy="no-referrer"
            />
            <div class="absolute inset-0 bg-gradient-to-b from-surface/0 via-surface/50 to-surface"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl animate-fade-in-up">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest mb-6">
                    Premium Learning Experience
                </span>
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] text-on-surface mb-8">
                    Master the <span class="text-primary">Architecture</span> of Tomorrow.
                </h1>
                <p class="text-xl text-tertiary leading-relaxed mb-10 max-w-xl">
                    Deep dive into computer science with our editorial-grade courses. From low-level systems to high-level AI architectures.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/catalog" class="px-8 py-4 rounded-full bg-primary text-white font-black text-lg shadow-2xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all flex items-center gap-2">
                        Explore Courses <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                    <a href="/pathway" class="px-8 py-4 rounded-full bg-surface-container-high text-on-surface font-black text-lg hover:bg-surface-container-highest transition-all inline-flex items-center">
                        View Curriculum
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 border-y border-surface-container-high">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                @php
                $stats = [
                    ['label' => 'Courses', 'value' => '120+'],
                    ['label' => 'Students', 'value' => '50k+'],
                    ['label' => 'Instructors', 'value' => '45'],
                    ['label' => 'Rating', 'value' => '4.9/5']
                ];
                @endphp
                
                @foreach($stats as $stat)
                <div class="flex flex-col items-center md:items-start">
                    <span class="text-4xl font-black text-primary tracking-tighter">{{ $stat['value'] }}</span>
                    <span class="text-sm font-bold text-tertiary uppercase tracking-widest">{{ $stat['label'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter text-on-surface mb-4">Why Ilmu Komputer?</h2>
                <p class="text-lg text-tertiary max-w-2xl mx-auto">We don't just teach code. We teach the fundamental principles that define the digital age.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                $features = [
                    ['icon' => 'cpu', 'title' => 'Systems Design', 'desc' => 'Understand how hardware and software interact at the deepest levels.'],
                    ['icon' => 'code', 'title' => 'Modern Stack', 'desc' => 'Master the tools used by world-class engineering teams today.'],
                    ['icon' => 'globe', 'title' => 'Global Network', 'desc' => 'Connect with a community of ambitious developers worldwide.']
                ];
                @endphp
                
                @foreach($features as $feature)
                <div class="p-8 rounded-3xl bg-surface-container-low border border-surface-container-high hover:border-primary/30 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-black tracking-tight text-on-surface mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-tertiary leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-primary text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
           <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
             <path d="M0 100 L100 0 L100 100 Z" fill="currentColor" />
           </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <h2 class="text-5xl md:text-7xl font-black tracking-tighter leading-none mb-8">Ready to start your journey?</h2>
                <p class="text-xl text-white/80 mb-10 leading-relaxed">Join thousands of students mastering computer science with our premium curriculum.</p>
                <a href="/register" class="inline-block px-10 py-5 rounded-full bg-white text-primary font-black text-xl shadow-2xl hover:scale-105 active:scale-95 transition-all">
                    Join Now
                </a>
            </div>
        </div>
    </section>
</div>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}
</style>
@endsection
