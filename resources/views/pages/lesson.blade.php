@extends('layouts.course')

@section('course-content')
<!-- We use AlpineJS to handle the sidebar toggle state -->
<div class="flex min-h-[calc(100vh-5rem)] bg-surface relative" x-data="{ isSidebarOpen: true, openSections: {{ Js::from($course->modules->pluck('id')->mapWithKeys(fn($id) => ['module-'.$id => ($currentLesson->module_id == $id)])) }} }">
    <!-- Main Content Area -->
    <div class="flex-1 transition-all duration-300" :class="isSidebarOpen ? 'xl:mr-96' : ''">
        <div class="px-6 lg:px-20 pt-12 pb-36 max-w-5xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary mb-8">
                <a href="/catalog" class="hover:text-primary cursor-pointer">Courses</a>
                <i data-lucide="chevron-right" class="w-2.5 h-2.5"></i>
                <a href="/course/{{ $course->id }}" class="hover:text-primary cursor-pointer">{{ $course->title }}</a>
                <i data-lucide="chevron-right" class="w-2.5 h-2.5"></i>
                <span class="text-primary">{{ $currentLesson->title }}</span>
            </nav>

            <article>
                <div class="prose prose-lg max-w-none prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary prose-pre:bg-surface-container-lowest prose-pre:text-on-surface prose-pre:border prose-pre:border-surface-container-high prose-pre:shadow-sm prose-blockquote:border-l-4 prose-blockquote:border-l-primary prose-blockquote:bg-surface-container-high/30 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:rounded-r-2xl prose-blockquote:not-italic prose-blockquote:text-on-surface prose-img:rounded-3xl prose-img:shadow-xl text-on-surface/90 leading-relaxed mb-12">
                    <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface leading-[0.9] !mb-12">
                        {{ $currentLesson->title }}
                    </h1>
                    {!! Str::markdown($currentLesson->content ?? '*No content available for this lesson.*') !!}
                </div>

                @if($currentLesson->type === 'quiz')
                {{-- === QUIZ BLOCK === --}}
                <div class="mt-4 mb-12">
                    {{-- Notifikasi Hasil Kuis (Dari Session Setelah Submit) --}}
                    @if(session('quiz_score') !== null)
                    <div class="mb-6 p-6 rounded-2xl flex items-center gap-5 {{ session('quiz_passed') ? 'bg-green-500/10 border border-green-500/20' : 'bg-red-500/10 border border-red-500/20' }}">
                        <div class="w-16 h-16 rounded-full shrink-0 flex items-center justify-center font-black text-xl {{ session('quiz_passed') ? 'bg-green-500 text-white shadow-lg shadow-green-500/30' : 'bg-red-500 text-white shadow-lg shadow-red-500/30' }}">
                            {{ session('quiz_score') }}
                        </div>
                        <div>
                            <div class="font-black text-lg {{ session('quiz_passed') ? 'text-green-600' : 'text-red-600' }}">
                                {{ session('quiz_passed') ? '🎉 Selamat! Anda Lulus!' : '😔 Belum Mencapai KKM (75)' }}
                            </div>
                            <p class="text-sm text-on-surface/70 mt-0.5">
                                {{ session('quiz_timeout') ? 'Waktu habis, kuis otomatis dikumpulkan.' : (session('quiz_passed') ? 'Pelajaran ini telah otomatis diselesaikan.' : 'Anda dapat mencoba kembali.') }}
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- Status Kelulusan --}}
                    @if($quizResult && $quizResult->passed)
                    <div class="mb-6 p-4 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center gap-3">
                        <i data-lucide="check-circle" class="text-green-500 w-5 h-5 shrink-0"></i>
                        <span class="font-bold text-green-700">Anda telah lulus kuis ini.</span>
                    </div>
                    @endif

                    {{-- Tombol Mulai Kuis --}}
                    <div class="p-8 rounded-3xl border border-surface-container-high bg-surface-container-low flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <div>
                            <div class="font-black text-2xl tracking-tighter text-on-surface mb-1">Ujian Materi</div>
                            <div class="text-sm text-tertiary flex items-center gap-4">
                                <span class="flex items-center gap-1.5"><i data-lucide="list-ordered" class="w-3.5 h-3.5"></i> {{ $currentLesson->questions->count() }} Soal</span>
                                <span class="flex items-center gap-1.5"><i data-lucide="timer" class="w-3.5 h-3.5"></i> {{ $currentLesson->time_limit_minutes ?? 30 }} Menit</span>
                                <span class="flex items-center gap-1.5"><i data-lucide="percent" class="w-3.5 h-3.5"></i> KKM 75</span>
                            </div>
                        </div>
                        @if(!($quizResult && $quizResult->passed))
                        <a href="{{ route('course.exam.show', [$course->id, $currentLesson->id]) }}"
                           class="shrink-0 flex items-center gap-2 px-8 py-3.5 rounded-full bg-primary text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                            <i data-lucide="play" class="w-4 h-4"></i>
                            Mulai Kuis
                        </a>
                        @else
                        <a href="{{ route('course.exam.show', [$course->id, $currentLesson->id]) }}"
                           class="shrink-0 flex items-center gap-2 px-8 py-3.5 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-high transition-all">
                            <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                            Coba Lagi
                        </a>
                        @endif
                    </div>

                    {{-- Histori Nilai --}}
                    @if($quizHistories->isNotEmpty())
                    <div class="mt-8">
                        <h3 class="font-black tracking-tight text-on-surface mb-4">Riwayat Percobaan</h3>
                        <div class="rounded-2xl overflow-hidden border border-surface-container-high">
                            <table class="w-full text-sm">
                                <thead class="bg-surface-container-high/60">
                                    <tr>
                                        <th class="text-left px-5 py-3 font-black text-xs uppercase tracking-widest text-tertiary">Percobaan</th>
                                        <th class="text-left px-5 py-3 font-black text-xs uppercase tracking-widest text-tertiary">Skor</th>
                                        <th class="text-left px-5 py-3 font-black text-xs uppercase tracking-widest text-tertiary">Status</th>
                                        <th class="text-left px-5 py-3 font-black text-xs uppercase tracking-widest text-tertiary">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container-high">
                                    @foreach($quizHistories as $history)
                                    <tr class="bg-surface-container-lowest hover:bg-surface-container-low transition-colors">
                                        <td class="px-5 py-3 font-bold">#{{ $history->attempt_number }}</td>
                                        <td class="px-5 py-3">
                                            <span class="font-black text-base {{ $history->passed ? 'text-green-600' : 'text-red-500' }}">{{ $history->score }}</span>
                                            <span class="text-tertiary">/100</span>
                                        </td>
                                        <td class="px-5 py-3">
                                            @if($history->passed)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                <i data-lucide="check" class="w-3 h-3"></i> Lulus
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-100 text-red-600 text-xs font-bold">
                                                <i data-lucide="x" class="w-3 h-3"></i> Belum Lulus
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-tertiary">{{ $history->created_at?->format('d M Y, H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </article>
        </div>
    </div>

    <!-- Sidebar - Course Content -->
    <aside class="hidden xl:flex h-[calc(100vh-5rem)] w-96 fixed right-0 top-20 bg-surface-container-low border-l border-surface-container-high flex-col px-8 pt-8 pb-30 gap-y-8 overflow-y-auto transition-transform duration-300"
           :class="isSidebarOpen ? 'translate-x-0' : 'translate-x-full'">
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-black tracking-tighter text-on-surface">Course Content</h2>
                <button @click="isSidebarOpen = false" class="text-tertiary hover:text-primary"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm font-black uppercase tracking-widest">
                    <span class="text-tertiary">{{ $progressPercent }}% Completed</span>
                    <span class="text-primary">{{ $completedLessonsCount }} / {{ $totalLessons }} Lessons</span>
                </div>
                <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
                    <div class="bg-primary h-full transition-all duration-1000" style="width: {{ $progressPercent }}%;"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 flex-grow">
            @foreach($course->modules as $module)
            <div class="rounded-3xl p-6 border border-transparent transition-all bg-surface-container-lowest shadow-sm ">
                <button @click="openSections['module-{{ $module->id }}'] = !openSections['module-{{ $module->id }}']"
                        class="flex items-center justify-between w-full font-black tracking-tight text-primary">
                    <span class="flex items-center gap-3 text-left">
                        <i data-lucide="network" class="w-[18px] h-[18px]"></i>
                        {{ $module->title }}
                    </span>
                    <span>
                        <i data-lucide="chevron-up" x-show="openSections['module-{{ $module->id }}']" class="w-5 h-5"></i>
                        <i data-lucide="chevron-down" x-show="!openSections['module-{{ $module->id }}']" class="w-5 h-5" style="display:none;"></i>
                    </span>
                </button>
                <div x-show="openSections['module-{{ $module->id }}']" class="mt-6 space-y-4">
                    @foreach($module->lessons as $lessonItem)
                    @php
                        $isCompleted = in_array($lessonItem->id, $completedLessonIds);
                    @endphp
                    <a href="/course/{{ $course->id }}/learn/{{ $lessonItem->id }}" class="flex items-center gap-3 text-sm text-left transition-colors group {{ $currentLesson->id == $lessonItem->id ? 'font-black text-primary' : 'font-bold text-on-surface hover:text-primary' }}">
                        @if($isCompleted)
                        <i data-lucide="check-circle" class="text-green-500 w-5 h-5 flex-shrink-0"></i>
                        @elseif($currentLesson->id == $lessonItem->id)
                        <div class="w-4 h-4 rounded-full border-2 border-primary flex items-center justify-center flex-shrink-0 ml-0.5">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                        </div>
                        @else
                        <div class="w-4 h-4 rounded-full border-2 border-on-surface flex-shrink-0 ml-0.5"></div>
                        @endif
                        <span>{{ $lessonItem->title }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <button disabled class="w-full py-4 rounded-2xl bg-surface-container-high text-tertiary flex items-center justify-center gap-2 font-black tracking-tight cursor-not-allowed  opacity-70 transition-all">
            View Certificate
            <span class="px-1.5 py-0.5 rounded bg-surface-container-highest text-tertiary text-[9px] uppercase">Soon</span>
        </button>
    </aside>

    <!-- Bottom Navigation Bar -->
    <footer class="fixed bottom-0 left-0 w-full h-20 z-50 bg-surface/90 backdrop-blur-xl border-t border-surface-container-high flex justify-between items-center px-8 lg:px-12 py-4 shadow-[0_-4px_24px_rgba(0,0,0,0.04)]"
            :class="isSidebarOpen ? 'xl:pr-[416px]' : ''">
        <div></div>
        
        <!-- Toggle Sidebar (Mobile/Tablet) -->
        <button @click="isSidebarOpen = !isSidebarOpen" class="hidden xl:flex items-center gap-2 px-4 py-2 border rounded-full text-tertiary uppercase text-xs font-black" x-show="!isSidebarOpen">
            <i data-lucide="menu" class="w-4 h-4"></i> Outline
        </button>

        <div class="flex gap-4">
            @if($prevLesson)
            <a href="/course/{{ $course->id }}/learn/{{ $prevLesson->id }}" class="flex items-center gap-2 px-6 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-high transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Prev
            </a>
            @endif

            <form action="/course/{{ $course->id }}/learn/{{ $currentLesson->id }}/complete" method="POST">
                @csrf
                @if(in_array($currentLesson->id, $completedLessonIds))
                <button type="submit" disabled class="flex items-center gap-2 px-8 py-3 rounded-full bg-green-500 text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-green-500/20 opacity-80 cursor-default">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    Completed
                </button>
                @elseif($currentLesson->type === 'quiz')
                <!-- Tahan tombol complete untuk Quiz, user dipaksa submit kuis untuk menyelesaikannya! -->
                <button type="button" disabled class="flex items-center gap-2 px-8 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs opacity-70 cursor-not-allowed">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Pass Quiz to Complete
                </button>
                @else
                <button type="submit" class="flex items-center gap-2 px-8 py-3 rounded-full bg-primary text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                    <i data-lucide="circle" class="w-4 h-4"></i>
                    Mark as Complete
                </button>
                @endif
            </form>

            @if($nextLesson)
            <a href="/course/{{ $course->id }}/learn/{{ $nextLesson->id }}" class="flex items-center gap-2 px-6 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-high transition-all">
                Next
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
            @else
            <a href="/dashboard" class="flex items-center gap-2 px-6 py-3 rounded-full bg-surface-container-high text-on-surface font-black uppercase tracking-widest text-xs hover:bg-surface-container-highest transition-all">
                Finish Course
                <i data-lucide="award" class="w-4 h-4"></i>
            </a>
            @endif
        </div>
    </footer>
</div>

<!-- KaTeX Auto-Render Engine -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {delimiters: [{left: '$$', right: '$$', display: true}, {left: '$', right: '$', display: false}]});"></script>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
