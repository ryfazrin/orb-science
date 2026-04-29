@extends('layouts.app')

@section('content')
<div class="flex min-h-[calc(100vh-5rem)] bg-surface relative"
      x-data="{
          currentQ:     0,
          answers:      {},
          totalQ:       {{ $lesson->questions->count() }},
          timeLeft:     0,
          timerStr:     '--:--',
          intervalId:   null,
          deadlineKey:  'exam_deadline_{{ $attempt->id }}',
          storageKey:   'exam_answers_{{ $attempt->id }}',
          serverRemaining: {{ $remainingSeconds }},
          sidebarOpen:  true,
          init() {
            // === LOAD JAWABAN ===
            const saved = localStorage.getItem(this.storageKey);
            if (saved) {
                try { this.answers = JSON.parse(saved); } catch(e) {}
            }
            this.$watch('answers', (val) => {
                localStorage.setItem(this.storageKey, JSON.stringify(val));
            });

            // === SETUP DEADLINE (fixed timestamp, tidak berubah saat refresh) ===
            let deadline = localStorage.getItem(this.deadlineKey);
            if (!deadline) {
                // Pertama kali buka: hitung deadline dari server remaining
                deadline = Date.now() + (this.serverRemaining * 1000);
                localStorage.setItem(this.deadlineKey, deadline);
            } else {
                deadline = parseInt(deadline);
            }

            // === TICK TIMER (hanya satu interval) ===
            const tick = () => {
                const remaining = Math.floor((deadline - Date.now()) / 1000);
                this.timeLeft = remaining;
                if (remaining <= 0) {
                    this.timerStr = '00:00';
                    clearInterval(this.intervalId);
                    localStorage.removeItem(this.storageKey);
                    localStorage.removeItem(this.deadlineKey);
                    this.$refs.examForm.submit();
                    return;
                }
                const m = String(Math.floor(remaining / 60)).padStart(2, '0');
                const s = String(remaining % 60).padStart(2, '0');
                this.timerStr = m + ':' + s;
            };

            tick(); // render langsung tanpa delay
            this.intervalId = setInterval(tick, 1000);
        },
        toggleSidebar() { this.sidebarOpen = !this.sidebarOpen; },
        clearAndSubmit() {
            clearInterval(this.intervalId);
            localStorage.removeItem(this.storageKey);
            localStorage.removeItem(this.deadlineKey);
            this.$refs.examForm.submit();
        },
        isAnswered(index) {
            const questions = {{ Js::from($lesson->questions->pluck('id')) }};
            return this.answers[questions[index]] !== undefined;
        }
     }">

    {{-- ===== HEADER (with timer + nav toggle) ===== --}}
    <header class="fixed top-0 left-0 right-0 h-20 z-50 bg-surface/90 backdrop-blur-xl border-b border-surface-container-high flex items-center px-6 lg:px-20">
        <div class="flex-1">
            <nav class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary">
                <a href="/course/{{ $course->id }}/learn/{{ $lesson->id }}" class="hover:text-primary">{{ $lesson->title }}</a>
                <i data-lucide="chevron-right" class="w-2.5 h-2.5"></i>
                <span class="text-primary">Ujian</span>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            <button type="button" @click="toggleSidebar()" class="px-3 py-2 rounded-full border border-surface-container-high text-tertiary hover:bg-surface-container-high transition-all">
                <i data-lucide="menu" class="w-4 h-4"></i>
            </button>

            <div class="flex items-center gap-2" :class="timeLeft < 60 ? 'text-red-500' : 'text-tertiary'">
                <i data-lucide="timer" class="w-5 h-5"></i>
                <span class="font-black text-xl tracking-tighter" x-text="timerStr">--:--</span>
            </div>
        </div>
    </header>

    {{-- ===== MAIN CONTENT AREA ===== --}}
    <div class="flex-1 xl:ml-80 transition-all duration-300">
        <div class="px-6 lg:px-20 pt-20 pb-36 max-w-4xl mx-auto">
            <form x-ref="examForm" method="POST" action="{{ route('course.exam.submit', [$course->id, $lesson->id]) }}">
                @csrf

                @foreach($lesson->questions as $i => $question)
                <div x-show="currentQ === {{ $i }}" style="{{ $i === 0 ? '' : 'display:none;' }}" x-transition.opacity.duration.300ms>

                    {{-- Question Header --}}
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <span class="text-xs font-black uppercase tracking-widest text-tertiary">Soal {{ $i + 1 }} / {{ $lesson->questions->count() }}</span>
                            <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold">{{ $question->points }} Poin</span>
                        </div>
                        <div class="prose prose-lg max-w-none text-on-surface">
                            {!! Str::markdown($question->question_text) !!}
                        </div>
                    </div>

                    {{-- Options --}}
                    <div class="space-y-3">
                        @foreach($question->options as $option)
                        <label class="flex items-center p-4 border rounded-2xl cursor-pointer hover:border-primary/50 transition-all group"
                               :class="answers[{{ $question->id }}] == {{ $option->id }}
                                   ? 'bg-primary/5 border-primary ring-1 ring-primary'
                                   : 'bg-surface-container-lowest border-surface-container-high'">
                            <input type="radio"
                                   name="answers[{{ $question->id }}]"
                                   value="{{ $option->id }}"
                                   x-model="answers[{{ $question->id }}]"
                                   class="w-5 h-5 text-primary border-surface-container-high focus:ring-primary cursor-pointer">
                            <span class="ml-4 font-medium text-on-surface/90 group-hover:text-on-surface">{{ $option->option_text }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </form>
        </div>
    </div>

    {{-- ===== SIDEBAR — Nomor Soal ===== --}}
            <aside x-show="sidebarOpen" x-transition.duration.300ms
                class="hidden xl:flex h-[calc(100vh-5rem)] w-80 fixed left-0 top-20 bg-surface-container-low border-r border-surface-container-high flex-col px-6 pt-8 pb-32 gap-y-6 overflow-y-auto">

        {{-- Info Kuis --}}
        <div>
            <div class="flex justify-end mb-3">
                <button type="button" @click="sidebarOpen = false" class="px-2 py-1 rounded-full border text-tertiary hover:bg-surface-container-high">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="text-xs font-black uppercase tracking-widest text-tertiary mb-1">Ujian</div>
            <div class="font-black text-xl tracking-tight text-on-surface">{{ $lesson->title }}</div>
        </div>

        {{-- Grid Nomor Soal --}}
        <div>
            <div class="text-xs font-black uppercase tracking-widest text-tertiary mb-3">Navigasi Soal</div>
            <div class="grid grid-cols-5 gap-2">
                @foreach($lesson->questions as $i => $question)
                <button type="button"
                        @click="currentQ = {{ $i }}"
                        :class="currentQ === {{ $i }}
                            ? 'bg-primary text-white ring-2 ring-primary ring-offset-2 ring-offset-surface-container-low'
                            : (isAnswered({{ $i }}) ? 'bg-green-500/20 text-green-700 border-green-300' : 'bg-surface-container-high/70 text-tertiary hover:bg-surface-container-highest')"
                        class="aspect-square rounded-xl text-sm font-black transition-all border border-transparent">
                    {{ $i + 1 }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- Legend --}}
        <div class="space-y-2 text-xs text-tertiary">
            <div class="flex items-center gap-2"><span class="w-4 h-4 rounded bg-primary inline-block"></span> Soal aktif</div>
            <div class="flex items-center gap-2"><span class="w-4 h-4 rounded bg-green-500/20 border border-green-300 inline-block"></span> Sudah dijawab</div>
            <div class="flex items-center gap-2"><span class="w-4 h-4 rounded bg-surface-container-highest inline-block"></span> Belum dijawab</div>
        </div>

        {{-- Progress Bar --}}
        <div class="mt-auto">
            <div class="flex justify-between text-xs font-bold text-tertiary mb-1.5">
                <span>Progress</span>
                <span x-text="Object.keys(answers).length + '/' + totalQ"></span>
            </div>
            <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
                <div class="bg-primary h-full transition-all duration-300"
                     :style="'width:' + (Object.keys(answers).length / totalQ * 100) + '%'"></div>
            </div>
        </div>
    </aside>

    {{-- Floating open button when sidebar is closed (desktop) --}}
    <button type="button" x-show="!sidebarOpen" @click="sidebarOpen = true"
            class="hidden xl:flex fixed left-4 top-1/2 -translate-y-1/2 z-40 px-3 py-2 bg-primary text-white rounded-full shadow-lg">
        <i data-lucide="chevrons-right" class="w-4 h-4"></i>
    </button>

    {{-- ===== BOTTOM FOOTER NAV ===== --}}
    <footer class="fixed bottom-0 left-0 w-full h-24 z-50 bg-surface/90 backdrop-blur-xl border-t border-surface-container-high flex justify-between items-center px-8 lg:px-12 shadow-[0_-4px_24px_rgba(0,0,0,0.04)] xl:pl-[336px]">

        <div></div>

        {{-- Prev / Next / Submit --}}
        <div class="flex items-center gap-3">
            <button type="button"
                    @click="currentQ = Math.max(0, currentQ - 1)"
                    x-show="currentQ > 0"
                    class="flex items-center gap-2 px-5 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-high transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Prev
            </button>

            <button type="button"
                    @click="currentQ = Math.min(totalQ - 1, currentQ + 1)"
                    x-show="currentQ < totalQ - 1"
                    class="flex items-center gap-2 px-6 py-3 rounded-full bg-primary text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                Next <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>

            <button type="button"
                    x-show="currentQ === totalQ - 1"
                    @click="clearAndSubmit()"
                    class="flex items-center gap-2 px-8 py-3 rounded-full bg-green-500 text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-green-500/20 hover:scale-105 active:scale-95 transition-all">
                <i data-lucide="check-circle" class="w-4 h-4"></i> Serahkan
            </button>
        </div>
    </footer>
</div>

{{-- KaTeX --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"
        onload="renderMathInElement(document.body,{delimiters:[{left:'$$',right:'$$',display:true},{left:'$',right:'$',display:false}]});"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
