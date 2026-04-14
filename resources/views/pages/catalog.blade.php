@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-12">
        <div class="max-w-xl">
            <h1 class="text-5xl font-black tracking-tighter text-on-surface mb-4">Course Catalog</h1>
            <p class="text-lg text-tertiary">Explore our curated collection of high-impact computer science courses.</p>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <div class="relative flex-grow md:w-80">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary w-5 h-5"></i>
                <input 
                    type="text" 
                    placeholder="Search courses..." 
                    class="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-low border border-surface-container-high focus:border-primary outline-none transition-all font-medium"
                />
            </div>
            <button class="p-3 rounded-2xl bg-surface-container-low border border-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all">
                <i data-lucide="filter" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
        $courses = [
            ['id' => 1, 'title' => 'Advanced Data Structures', 'category' => 'Computer Science', 'level' => 'Advanced', 'duration' => '12 Weeks', 'rating' => 4.9, 'image' => 'https://picsum.photos/seed/data/800/600', 'price' => '$199'],
            ['id' => 2, 'title' => 'Distributed Systems Architecture', 'category' => 'Systems', 'level' => 'Expert', 'duration' => '16 Weeks', 'rating' => 4.8, 'image' => 'https://picsum.photos/seed/systems/800/600', 'price' => '$249'],
            ['id' => 3, 'title' => 'Modern Web Performance', 'category' => 'Web Dev', 'level' => 'Intermediate', 'duration' => '8 Weeks', 'rating' => 4.7, 'image' => 'https://picsum.photos/seed/web/800/600', 'price' => '$149'],
            ['id' => 4, 'title' => 'Machine Learning Foundations', 'category' => 'AI/ML', 'level' => 'Beginner', 'duration' => '10 Weeks', 'rating' => 4.9, 'image' => 'https://picsum.photos/seed/ai/800/600', 'price' => '$179'],
            ['id' => 5, 'title' => 'Cybersecurity Fundamentals', 'category' => 'Security', 'level' => 'Intermediate', 'duration' => '12 Weeks', 'rating' => 4.6, 'image' => 'https://picsum.photos/seed/security/800/600', 'price' => '$189'],
            ['id' => 6, 'title' => 'Cloud Native Engineering', 'category' => 'Cloud', 'level' => 'Advanced', 'duration' => '14 Weeks', 'rating' => 4.8, 'image' => 'https://picsum.photos/seed/cloud/800/600', 'price' => '$219']
        ];
        @endphp

        @foreach($courses as $course)
        <a 
            href="/course/{{ $course['id'] }}"
            class="group flex flex-col bg-surface-container-low rounded-[2rem] border border-surface-container-high overflow-hidden hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 cursor-pointer block"
        >
            <div class="relative aspect-[4/3] overflow-hidden">
                <img 
                    src="{{ $course['image'] }}" 
                    alt="{{ $course['title'] }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    referrerpolicy="no-referrer"
                />
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-primary text-xs font-black uppercase tracking-widest shadow-sm">
                        {{ $course['category'] }}
                    </span>
                </div>
            </div>
            <div class="p-8 flex flex-col flex-grow">
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex items-center text-yellow-500">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <span class="ml-1 text-sm font-black text-on-surface">{{ $course['rating'] }}</span>
                    </div>
                    <span class="text-tertiary text-xs">•</span>
                    <span class="text-tertiary text-xs font-bold uppercase tracking-widest">{{ $course['level'] }}</span>
                </div>
                <h3 class="text-2xl font-black tracking-tight text-on-surface mb-4 group-hover:text-primary transition-colors leading-tight">
                    {{ $course['title'] }}
                </h3>
                <div class="mt-auto pt-6 border-t border-surface-container-high flex items-center justify-between">
                    <div class="flex items-center gap-4 text-tertiary">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            <span class="text-sm font-bold">{{ $course['duration'] }}</span>
                        </div>
                    </div>
                    <span class="text-2xl font-black text-primary">{{ $course['price'] }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-20 text-center">
        <button class="px-10 py-4 rounded-full border-2 border-surface-container-high text-on-surface font-black hover:bg-surface-container-low transition-all">
            Load More Courses
        </button>
    </div>
</div>
@endsection
