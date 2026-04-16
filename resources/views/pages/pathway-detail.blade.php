@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary mb-8">
        <a href="/pathway" class="hover:text-primary transition-colors">Learning Paths</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span style="color: {{ $pathway->color ?? '#6c63ff' }};">{{ $pathway->title }}</span>
    </nav>

    {{-- Hero Header --}}
    <header class="mb-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-2xl">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                         style="background-color: {{ $pathway->color ?? '#6c63ff' }}1a;">
                        <i data-lucide="{{ $pathway->icon ?? 'map' }}" class="w-8 h-8"
                           style="color: {{ $pathway->color ?? '#6c63ff' }};"></i>
                    </div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest"
                          style="background-color: {{ $pathway->color ?? '#6c63ff' }}1a; color: {{ $pathway->color ?? '#6c63ff' }};">
                        Learning Path
                    </span>
                </div>
                <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface mb-4 leading-[0.9]">
                    {{ $pathway->title }}
                </h1>
                @if($pathway->description)
                <p class="text-lg text-tertiary font-medium">{{ $pathway->description }}</p>
                @endif
            </div>

            {{-- Stats Card --}}
            @php
                $totalCourses     = $pathway->levels->flatMap->courses->count();
                $enrolledInPath   = collect($enrolledCourseIds)->intersect($pathway->levels->flatMap->courses->pluck('id'))->count();
                $completedInPath  = collect($completedCourseIds)->intersect($pathway->levels->flatMap->courses->pluck('id'))->count();
                $progressPercent  = $totalCourses > 0 ? round(($completedInPath / $totalCourses) * 100) : 0;
            @endphp
            <div class="bg-surface-container-lowest p-8 rounded-[2.5rem] shadow-md border border-surface-container-high min-w-[280px]">
                <div class="flex justify-between items-end mb-3">
                    <span class="text-xs font-black text-tertiary uppercase tracking-widest">Progress Jalur</span>
                    <span class="text-3xl font-black tracking-tighter" style="color: {{ $pathway->color ?? '#6c63ff' }};">{{ $progressPercent }}%</span>
                </div>
                <div class="w-full bg-surface-container-high h-2.5 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000"
                         style="width: {{ $progressPercent }}%; background-color: {{ $pathway->color ?? '#6c63ff' }};"></div>
                </div>
                <p class="mt-4 text-xs text-tertiary font-bold uppercase tracking-widest">
                    {{ $completedInPath }} dari {{ $totalCourses }} kursus selesai
                </p>
            </div>
        </div>
    </header>

    {{-- ====== SKILL TREE / TIMELINE BERJENJANG ====== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <div class="lg:col-span-8 flex flex-col gap-16">

            @forelse($pathway->levels as $level)
            @php
                $levelCompleted = $level->courses->filter(fn($c) => in_array($c->id, $completedCourseIds))->count();
                $levelTotal = $level->courses->count();
                $levelDone = $levelTotal > 0 && $levelCompleted === $levelTotal;
            @endphp

            <div>
                {{-- Level Header --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-black shrink-0
                        {{ $levelDone ? 'bg-green-500' : '' }}"
                        style="{{ $levelDone ? '' : 'background-color: ' . ($pathway->color ?? '#6c63ff') . ';' }}">
                        @if($levelDone)
                        <i data-lucide="check" class="w-5 h-5"></i>
                        @else
                        {{ $loop->index + 1 }}
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-2xl font-black tracking-tight text-on-surface">{{ $level->title }}</h2>
                        @if($level->description)
                        <p class="text-sm text-tertiary mt-0.5">{{ $level->description }}</p>
                        @endif
                    </div>
                    <div class="text-xs font-black uppercase tracking-widest text-tertiary shrink-0">
                        {{ $levelCompleted }}/{{ $levelTotal }} Selesai
                    </div>
                </div>

                {{-- Kursus dalam Level --}}
                @if($level->courses->isEmpty())
                <div class="p-6 border border-dashed border-surface-container-high rounded-2xl text-center text-tertiary text-sm">
                    Belum ada kursus di level ini.
                </div>
                @else
                <div class="relative flex flex-col gap-6">
                    {{-- Garis vertikal penghubung --}}
                    @if(!$loop->last)
                    <div class="absolute left-7 -bottom-16 w-0.5 h-16 bg-surface-container-high"></div>
                    @endif

                    @foreach($level->courses as $courseIdx => $course)
                    @php
                        $isEnrolled   = in_array($course->id, $enrolledCourseIds);
                        $isCompleted  = in_array($course->id, $completedCourseIds);
                        $totalLessons = $course->modules->flatMap->lessons->count();
                        $totalHrs     = round($course->modules->flatMap->lessons->sum('duration_minutes') / 60, 1);
                    @endphp
                    <div class="flex gap-6 group">
                        {{-- Node Indikator --}}
                        <div class="flex flex-col items-center shrink-0">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center ring-8 ring-surface z-10
                                {{ $isCompleted ? 'bg-green-500 text-white shadow-lg shadow-green-500/30' : ($isEnrolled ? 'text-white' : 'bg-surface-container-high text-tertiary') }}"
                                 style="{{ $isEnrolled && !$isCompleted ? 'background-color:' . ($pathway->color ?? '#6c63ff') . '; box-shadow: 0 8px 24px ' . ($pathway->color ?? '#6c63ff') . '33;' : '' }}">
                                @if($isCompleted)
                                    <i data-lucide="check-circle" class="w-6 h-6 fill-current"></i>
                                @elseif($isEnrolled)
                                    <i data-lucide="play-circle" class="w-6 h-6 fill-current"></i>
                                @else
                                    <span class="font-black text-sm">{{ $courseIdx + 1 }}</span>
                                @endif
                            </div>
                            @if(!$loop->last)
                            <div class="w-0.5 flex-grow mt-2 bg-surface-container-high min-h-6"></div>
                            @endif
                        </div>

                        {{-- Course Card --}}
                        <div class="flex-1 bg-surface-container-lowest rounded-[2rem] border p-7 transition-all hover:scale-[1.005] group-hover:shadow-md
                            {{ $isCompleted ? 'border-green-500/20' : ($isEnrolled ? 'border-primary/20' : 'border-surface-container-high') }}">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4">
                                <div>
                                    @if($isCompleted)
                                    <span class="inline-flex items-center gap-1 text-xs font-black uppercase tracking-widest text-green-600 mb-2">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Selesai
                                    </span>
                                    @elseif($isEnrolled)
                                    <span class="inline-flex items-center gap-1 text-xs font-black uppercase tracking-widest mb-2"
                                          style="color: {{ $pathway->color ?? '#6c63ff' }};">
                                        <i data-lucide="zap" class="w-3.5 h-3.5"></i> Sedang Dipelajari
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 text-xs font-black uppercase tracking-widest text-tertiary mb-2">
                                        <i data-lucide="circle" class="w-3.5 h-3.5"></i> Tersedia
                                    </span>
                                    @endif
                                    <h3 class="text-xl font-black tracking-tight text-on-surface">{{ $course->title }}</h3>
                                </div>
                                <div class="flex items-center gap-2 text-xs font-bold text-tertiary shrink-0">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    {{ $totalHrs }} jam
                                </div>
                            </div>

                            @if($course->description ?? null)
                            <p class="text-tertiary text-sm leading-relaxed mb-5">{{ Str::limit($course->description, 120) }}</p>
                            @endif

                            <div class="flex items-center justify-between pt-5 border-t border-surface-container-high">
                                <span class="text-xs text-tertiary font-bold">{{ $totalLessons }} Pelajaran</span>
                                @if($isCompleted)
                                <a href="{{ url('/course/' . $course->id) }}"
                                   class="text-xs font-black uppercase tracking-widest text-green-600 flex items-center gap-1.5 hover:underline">
                                    Tinjau Ulang <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                                @elseif($isEnrolled)
                                <a href="{{ url('/course/' . $course->id) }}"
                                   class="px-5 py-2 rounded-full text-xs font-black uppercase tracking-widest text-white hover:opacity-90 transition-all"
                                   style="background-color: {{ $pathway->color ?? '#6c63ff' }};">
                                    Lanjut Belajar
                                </a>
                                @else
                                <a href="{{ url('/course/' . $course->id) }}"
                                   class="px-5 py-2 rounded-full border border-surface-container-high text-xs font-black uppercase tracking-widest text-tertiary hover:bg-surface-container-high transition-all">
                                    Lihat Kursus
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-24 border border-dashed border-surface-container-high rounded-3xl">
                <i data-lucide="layers" class="w-12 h-12 text-tertiary mx-auto mb-3 opacity-40"></i>
                <p class="font-black text-on-surface">Belum ada level</p>
            </div>
            @endforelse
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start">

            {{-- Ringkasan Jalur --}}
            <div class="bg-surface-container-lowest p-7 rounded-[2rem] border border-surface-container-high">
                <h3 class="font-black text-lg tracking-tight text-on-surface mb-5">Ringkasan Jalur</h3>
                <div class="space-y-4">
                    @foreach($pathway->levels as $level)
                    @php
                        $lc = $level->courses->filter(fn($c) => in_array($c->id, $completedCourseIds))->count();
                        $lt = $level->courses->count();
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-bold text-on-surface">{{ $level->title }}</span>
                            <span class="text-tertiary text-xs">{{ $lc }}/{{ $lt }}</span>
                        </div>
                        <div class="w-full bg-surface-container-high h-1.5 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-700"
                                 style="width: {{ $lt > 0 ? round($lc/$lt*100) : 0 }}%; background-color: {{ $pathway->color ?? '#6c63ff' }};"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-6 border-t border-surface-container-high grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-black" style="color: {{ $pathway->color ?? '#6c63ff' }};">{{ $totalCourses }}</div>
                        <div class="text-xs text-tertiary font-bold uppercase tracking-widest mt-0.5">Kursus</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-on-surface">{{ $pathway->levels->count() }}</div>
                        <div class="text-xs text-tertiary font-bold uppercase tracking-widest mt-0.5">Level</div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            @if(!auth()->check())
            <div class="bg-on-surface text-surface p-7 rounded-[2rem] relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-xl font-black tracking-tight mb-2">Mulai Perjalanan Anda</h3>
                    <p class="text-surface/70 text-sm mb-5">Daftar gratis dan lacak progress karir Anda.</p>
                    <a href="/register" class="inline-block bg-surface text-on-surface px-6 py-3 rounded-full font-black text-xs uppercase tracking-widest hover:scale-105 transition-all">
                        Daftar Sekarang
                    </a>
                </div>
                <div class="absolute -right-6 -bottom-6 opacity-10">
                    <i data-lucide="{{ $pathway->icon ?? 'map' }}" class="w-32 h-32"></i>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
