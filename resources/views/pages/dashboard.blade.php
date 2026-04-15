@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="mb-12">
        <h1 class="text-5xl font-black tracking-tighter text-on-surface mb-2">Welcome back, {{ explode(' ', $user->name)[0] }}</h1>
        <p class="text-lg text-tertiary">
            {{-- You've completed 40% of your current --}}
            <a href="/pathway" class="text-primary font-bold hover:underline">learning path</a>.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <section>
                <h2 class="text-2xl font-black tracking-tight text-on-surface mb-6 flex items-center gap-2">
                    Continue Learning <i data-lucide="chevron-right" class="text-primary w-5 h-5"></i>
                </h2>
                <div class="grid gap-6">
                    @foreach($enrollments as $enrollment)
                    <div class="flex flex-col sm:flex-row bg-surface-container-low rounded-3xl border border-surface-container-high overflow-hidden hover:border-primary/30 transition-all group">
                        <div class="w-full sm:w-48 aspect-video sm:aspect-square overflow-hidden">
                            <img 
                                src="{{ $enrollment->course->thumbnail_url ?? 'https://picsum.photos/seed/'.$enrollment->course_id.'/400/300' }}" 
                                alt="{{ $enrollment->course->title }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                referrerpolicy="no-referrer"
                            />
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-center">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-black tracking-tight text-on-surface">{{ $enrollment->course->title }}</h3>
                                <span class="text-xs font-bold text-tertiary uppercase tracking-widest">{{ \Carbon\Carbon::parse($enrollment->updated_at)->diffForHumans() }}</span>
                            </div>
                            <div class="mb-6">
                                <div class="flex justify-between text-sm font-bold text-tertiary mb-2">
                                    <span>Progress</span>
                                    <span>{{ $enrollment->progress_percentage }}%</span>
                                </div>
                                <div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
                                    <div 
                                        class="h-full bg-primary transition-all duration-1000" 
                                        style="width: {{ $enrollment->progress_percentage }}%"
                                    ></div>
                                </div>
                            </div>
                            <a 
                                href="/course/{{ $enrollment->course_id }}"
                                class="self-start px-6 py-2 rounded-full bg-primary text-white font-bold text-sm flex items-center gap-2 hover:scale-105 active:scale-95 transition-all"
                            >
                                <i data-lucide="play" class="w-4 h-4 fill-current"></i> Resume
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-black tracking-tight text-on-surface mb-6 flex items-center gap-3">
                    Recommended for You
                    <span class="px-2 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[10px] uppercase font-black border border-yellow-500/20">Coming Soon</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach([1, 2] as $i)
                    <div class="p-6 rounded-3xl bg-surface-container-low border border-surface-container-high hover:tonal-lift transition-all">
                        <div class="w-full aspect-video rounded-2xl bg-surface-container-high mb-4 overflow-hidden">
                            <img 
                                src="https://picsum.photos/seed/rec{{ $i }}/600/400" 
                                alt="Recommended" 
                                class="w-full h-full object-cover"
                                referrerpolicy="no-referrer"
                            />
                        </div>
                        <h3 class="text-lg font-black tracking-tight text-on-surface mb-2">System Design Interview Guide</h3>
                        <p class="text-sm text-tertiary mb-4">Master the art of scaling applications for millions of users.</p>
                        <a 
                            href="/course/1"
                            class="text-primary font-bold text-sm hover:underline"
                        >
                            View Details
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <div class="p-8 rounded-[2.5rem] bg-primary text-white shadow-2xl shadow-primary/20">
                <h3 class="text-2xl font-black tracking-tight mb-4 flex justify-between items-center">
                    Your Achievements
                    <span class="px-2 py-0.5 rounded bg-white/20 text-white text-[10px] uppercase font-black">Coming Soon</span>
                </h3>
                <div class="space-y-6">
                    @php
                    $achievements = [
                        ['icon' => 'award', 'title' => 'Fast Learner', 'desc' => 'Completed 5 lessons in a day'],
                        ['icon' => 'check-circle', 'title' => 'Perfect Score', 'desc' => '100% on Data Structures quiz'],
                        ['icon' => 'clock', 'title' => 'Consistent', 'desc' => '7 day learning streak']
                    ];
                    @endphp

                    @foreach($achievements as $ach)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                            <i data-lucide="{{ $ach['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold leading-none mb-1">{{ $ach['title'] }}</h4>
                            <p class="text-xs text-white/70">{{ $ach['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="p-8 rounded-[2.5rem] bg-surface-container-low border border-surface-container-high">
                <h3 class="text-xl font-black tracking-tight text-on-surface mb-6 flex justify-between items-center">
                    Upcoming Events
                    <span class="px-2 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[10px] uppercase font-black border border-yellow-500/20">Coming Soon</span>
                </h3>
                <div class="space-y-6">
                    @foreach([1, 2] as $i)
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-surface-container-high flex flex-col items-center justify-center">
                            <span class="text-xs font-black text-primary leading-none">OCT</span>
                            <span class="text-lg font-black text-on-surface leading-none">1{{ $i }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface leading-tight mb-1">Live Q&A: Distributed Systems</h4>
                            <p class="text-xs text-tertiary">4:00 PM - 5:30 PM</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="w-full mt-8 py-3 rounded-2xl border border-surface-container-high text-sm font-bold text-on-surface hover:bg-surface-container-high transition-all">
                    View All Events
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
