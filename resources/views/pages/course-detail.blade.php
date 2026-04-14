@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Hero Section -->
    <section class="mb-20 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="order-2 lg:order-1">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 text-primary font-black text-xs mb-8 uppercase tracking-widest">
                <i data-lucide="award" class="w-[14px] h-[14px]"></i>
                BESTSELLER COURSE
            </div>
            <h1 class="text-5xl lg:text-7xl font-black text-on-surface mb-8 leading-[0.9] tracking-tighter">
                Mastering <span class="text-primary">Python</span> for Beginners
            </h1>
            <p class="text-xl text-tertiary mb-10 leading-relaxed max-w-xl font-medium">
                Finally, a programming course designed for human beings. No complex jargon, just clear, step-by-step guidance to build your first apps.
            </p>
            <div class="flex flex-wrap gap-6 items-center">
                <a href="/checkout" class="inline-block bg-primary text-white px-10 py-5 rounded-full font-black text-lg shadow-2xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Enroll Now — Rp 499.000
                </a>
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        @foreach([1, 2, 3] as $i)
                        <img 
                            class="w-12 h-12 rounded-full border-4 border-surface" 
                            src="https://picsum.photos/seed/student{{ $i }}/100/100"
                            alt="Student"
                            referrerpolicy="no-referrer"
                        />
                        @endforeach
                    </div>
                    <span class="text-sm font-bold text-tertiary uppercase tracking-widest">+12.4k Students</span>
                </div>
            </div>
        </div>
        <div class="order-1 lg:order-2 relative">
            <div class="aspect-video rounded-[2.5rem] overflow-hidden shadow-2xl bg-surface-container-high relative group">
                <img 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                    src="https://picsum.photos/seed/python/1200/800"
                    alt="Course Preview"
                    referrerpolicy="no-referrer"
                />
                <div class="absolute inset-0 bg-on-surface/20 flex items-center justify-center">
                    <button class="w-24 h-24 bg-white text-primary rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
                        <i data-lucide="play" class="w-10 h-10 ml-2 fill-current"></i>
                    </button>
                </div>
            </div>
            <div class="absolute -bottom-8 -left-8 bg-surface-container-lowest p-8 rounded-[2rem] shadow-2xl hidden md:block border border-surface-container-high">
                <div class="flex items-center gap-4">
                    <div class="bg-primary/10 p-4 rounded-2xl text-primary">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-xs text-tertiary font-black uppercase tracking-widest">Duration</p>
                        <p class="text-2xl font-black text-on-surface tracking-tighter">12.5 Hours</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Meta Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-32">
        @php
        $metas = [
            ['icon' => 'bar-chart', 'label' => 'Difficulty', 'value' => 'Absolute Beginner'],
            ['icon' => 'globe', 'label' => 'Language', 'value' => 'Bahasa Indonesia'],
            ['icon' => 'refresh-cw', 'label' => 'Last Updated', 'value' => 'Jan 2026'],
            ['icon' => 'award', 'label' => 'Certificate', 'value' => 'Included']
        ];
        @endphp
        @foreach($metas as $item)
        <div class="bg-surface-container-low p-8 rounded-[2rem] flex flex-col gap-3 border border-surface-container-high">
            <div class="text-primary"><i data-lucide="{{ $item['icon'] }}"></i></div>
            <span class="text-xs font-black text-tertiary uppercase tracking-widest">{{ $item['label'] }}</span>
            <p class="font-black text-on-surface">{{ $item['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-20">
        <div class="lg:col-span-2">
            <!-- Syllabus -->
            <section class="mb-20" x-data="{ openModule: 1 }">
                <h2 class="text-4xl font-black mb-12 flex items-center gap-4 tracking-tighter">
                    <span class="w-2 h-10 bg-primary rounded-full"></span>
                    Course Syllabus
                </h2>
                <div class="space-y-6">
                    @php
                    $modules = [
                        ['id' => 1, 'title' => 'Foundations of Python', 'lessons' => 8, 'open' => true],
                        ['id' => 2, 'title' => 'Control Flow & Logic', 'lessons' => 12, 'open' => false],
                        ['id' => 3, 'title' => 'Real-World Projects', 'lessons' => 5, 'open' => false]
                    ];
                    @endphp
                    @foreach($modules as $module)
                    <div class="bg-surface-container-low rounded-[2rem] border border-surface-container-high overflow-hidden" 
                         x-data="{ open: {{ $module['open'] ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full p-8 flex justify-between items-center text-left focus:outline-none">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center font-black text-primary">{{ $module['id'] }}</div>
                                <span class="text-xl font-black tracking-tight">{{ $module['title'] }}</span>
                            </div>
                            <i data-lucide="chevron-down" x-show="!open" class="w-6 h-6"></i>
                            <i data-lucide="chevron-up" x-show="open" style="display: none;" class="w-6 h-6"></i>
                        </button>
                        
                        <div x-show="open" class="px-8 pb-8 space-y-4">
                            <a href="/lesson/1" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors group block">
                                <i data-lucide="play-circle" class="text-primary w-5 h-5"></i>
                                <span class="flex-grow font-bold text-tertiary group-hover:text-on-surface">Installing Python & VS Code</span>
                                <span class="text-xs font-black text-tertiary">08:45</span>
                            </a>
                            <a href="/lesson/2" class="flex items-center gap-4 p-4 rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors group block">
                                <i data-lucide="play-circle" class="text-primary w-5 h-5"></i>
                                <span class="flex-grow font-bold text-tertiary group-hover:text-on-surface">Variables and Data Types</span>
                                <span class="text-xs font-black text-tertiary">15:20</span>
                            </a>
                            <div class="flex items-center gap-4 p-4 rounded-2xl opacity-50">
                                <i data-lucide="file-text" class="text-tertiary w-5 h-5"></i>
                                <span class="flex-grow font-bold text-tertiary">Practice Quiz: Foundations</span>
                                <i data-lucide="lock" class="text-tertiary w-4 h-4"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Reviews -->
            <section>
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-4xl font-black flex items-center gap-4 tracking-tighter">
                        <span class="w-2 h-10 bg-primary rounded-full"></span>
                        Student Reviews
                    </h2>
                    <div class="flex items-center gap-2 text-primary">
                        <i data-lucide="star" class="w-6 h-6 fill-current"></i>
                        <span class="font-black text-3xl tracking-tighter">4.9</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @php
                    $reviews = [
                        ['name' => 'Budi Santoso', 'text' => '"As a complete \'gaptek\' person, I was terrified of coding. This course made it feel like playing with LEGO. Sangat membantu!"'],
                        ['name' => 'Siti Aminah', 'text' => '"The instructor\'s explanations are so clear. I managed to automate my repetitive office tasks in just 2 weeks!"']
                    ];
                    @endphp
                    @foreach($reviews as $i => $review)
                    <div class="bg-surface-container-low p-10 rounded-[2.5rem] border border-surface-container-high flex flex-col gap-6">
                        <div class="flex items-center gap-4">
                            <img class="w-14 h-14 rounded-full" src="https://picsum.photos/seed/rev{{ $i }}/100/100" alt="{{ $review['name'] }}" referrerpolicy="no-referrer" />
                            <div>
                                <p class="font-black text-on-surface">{{ $review['name'] }}</p>
                                <div class="flex text-primary">
                                    @foreach([1,2,3,4,5] as $s)
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <p class="text-tertiary leading-relaxed italic font-medium">{{ $review['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <aside class="space-y-12">
            <!-- Instructor -->
            <section class="bg-surface-container-lowest p-10 rounded-[2.5rem] shadow-2xl shadow-primary/5 border border-surface-container-high">
                <h3 class="text-2xl font-black mb-8 tracking-tight">Your Instructor</h3>
                <div class="flex flex-col items-center text-center">
                    <img class="w-32 h-32 rounded-full mb-6 ring-4 ring-primary/10" src="https://picsum.photos/seed/raka/200/200" alt="Instructor" referrerpolicy="no-referrer" />
                    <h4 class="text-2xl font-black mb-1">Raka Kurnia</h4>
                    <p class="text-primary font-black text-xs uppercase tracking-widest mb-6">Senior Developer @ TechCo</p>
                    <p class="text-sm text-tertiary leading-relaxed font-medium">
                        Raka has taught over 50,000 students globally. He specializes in making complex computer science topics accessible to everyone.
                    </p>
                    <div class="flex gap-4 mt-8">
                        <button class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 hover:text-primary transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </button>
                        <button class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 hover:text-primary transition-colors">
                            <i data-lucide="globe" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </section>

            <!-- Prerequisites -->
            <section class="bg-surface-container-low p-10 rounded-[2.5rem] border border-surface-container-high">
                <h3 class="text-2xl font-black mb-8 flex items-center gap-3 tracking-tight">
                    <i data-lucide="check-square" class="text-primary w-6 h-6"></i>
                    Prerequisites
                </h3>
                <ul class="space-y-6">
                    @php
                    $prereqs = [
                        'Basic computer literacy (typing, opening files)',
                        'A laptop (Windows, Mac, or Linux)',
                        'A stable internet connection for videos',
                        'A curious mind and a willingness to try!'
                    ];
                    @endphp
                    @foreach($prereqs as $item)
                    <li class="flex gap-4">
                        <div class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </div>
                        <span class="text-tertiary font-bold leading-tight">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </section>

            <!-- Floating Sticky CTA -->
            <div class="hidden lg:block sticky top-28 p-10 border-2 border-primary/20 rounded-[2.5rem] bg-surface-container-lowest shadow-2xl shadow-primary/5">
                <p class="text-xs font-black text-tertiary mb-2 uppercase tracking-widest">Lifetime Access</p>
                <div class="text-4xl font-black text-on-surface mb-8 tracking-tighter">Rp 499.000</div>
                <a href="/checkout" class="block w-full text-center py-5 bg-primary text-white rounded-full font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all mb-6">
                    Enroll Now
                </a>
                <p class="text-xs text-center text-tertiary font-bold uppercase tracking-widest">30-day money back guarantee</p>
            </div>
        </aside>
    </div>
</div>

<!-- Add AlpineJS for simple click-to-expand syllabus functionality -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
