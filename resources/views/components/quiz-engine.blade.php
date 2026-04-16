<div class="mt-8" x-data="{
    currentQuestionIndex: 0,
    answers: {},
    questions: {{ Js::from($lesson->questions) }},
    submitForm() {
        this.$refs.quizForm.submit();
    }
}">
    <h1 class="text-4xl md:text-5xl font-black tracking-tighter text-on-surface leading-[0.9] !mb-4">
        {{ $lesson->title }}
    </h1>
    <div class="mb-12 text-tertiary">
        Syarat Kelulusan Kuis: <span class="font-bold text-on-surface tracking-tight">Minimum Skor 75%</span>
    </div>

    @if(session('quiz_score') !== null)
        <div class="mb-12 p-8 rounded-3xl {{ session('quiz_passed') ? 'bg-green-500/10 border border-green-500/20' : 'bg-red-500/10 border border-red-500/20' }} flex flex-col sm:flex-row items-center gap-6">
            <div class="{{ session('quiz_passed') ? 'bg-green-500' : 'bg-red-500' }} text-white w-20 h-20 rounded-full flex items-center justify-center font-black text-2xl tracking-tighter shrink-0 shadow-xl {{ session('quiz_passed') ? 'shadow-green-500/30' : 'shadow-red-500/30' }}">
                {{ session('quiz_score') }}
            </div>
            <div>
                <h3 class="text-2xl font-black tracking-tight {{ session('quiz_passed') ? 'text-green-500' : 'text-red-500' }} mb-2">
                    {{ session('quiz_passed') ? 'Selamat! Anda Berhasil Lulus!' : 'Skor Anda di Bawah KKM.' }}
                </h3>
                <p class="text-on-surface/80">
                    {{ session('quiz_passed') ? 'Anda telah berhasil menguasai materi ini. Silakan melanjutkan perjalanan dengan menekan tombol \'Next\' di bar navigasi.' : 'Jangan menyerah! Anda dapat mengulangi kuis ini sebanyak yang diperlukan untuk memahaminya.' }}
                </p>
            </div>
        </div>
    @elseif($quizResult)
        <div class="mb-12 p-6 rounded-3xl bg-surface-container-high/30 flex items-center gap-4">
            <i data-lucide="check-square" class="text-primary w-8 h-8"></i>
            <div>
                <div class="font-bold">Anda telah mengambil kuis ini.</div>
                <div class="text-sm text-tertiary">Skor tertinggi Anda: <span class="font-bold text-on-surface">{{ $quizResult->score }}</span>/100</div>
            </div>
        </div>
    @endif

    <!-- AlpineJS Test UI -->
    <template x-if="questions.length > 0 && {{ session('quiz_passed') || ($quizResult && $quizResult->passed) ? 'false' : 'true' }}">
        <form x-ref="quizForm" method="POST" action="{{ route('course.lesson.quiz.submit', [$course->id, $lesson->id]) }}">
            @csrf
            
            <div class="bg-surface-container-low border border-surface-container-high p-8 rounded-3xl shadow-sm relative overflow-hidden">
                <!-- Progress Line -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-surface-container-highest">
                    <div class="h-full bg-primary transition-all duration-300" :style="`width: ${((currentQuestionIndex + 1) / questions.length) * 100}%`"></div>
                </div>

                <div class="flex justify-between items-center mb-8 pt-2">
                    <div class="text-sm font-black uppercase tracking-widest text-tertiary">Soal <span x-text="currentQuestionIndex + 1"></span> dari <span x-text="questions.length"></span></div>
                    <div class="text-sm border border-primary/20 bg-primary/5 text-primary tracking-tight font-bold px-3 py-1 rounded-full"><span x-text="questions[currentQuestionIndex].points"></span> Poin</div>
                </div>

                <!-- Markdown Content Render of Question (Handled by Alpine x-html for basics, or blade for robust KaTeX) -->
                <template x-for="(question, index) in questions" :key="question.id">
                    <div x-show="currentQuestionIndex === index" x-transition.opacity.duration.300ms>
                        <!-- For Katex rendering dynamically, it's complex inside Alpine template, we'll output all questions but hide them via CSS instead of template removal to ensure Katex parses them once on page load -->
                    </div>
                </template>

                <!-- Since KaTeX auto-render scopes over DOM on load, we MUST render all questions in pure Blade and toggle visibility using Alpine to preserve math rendering -->
                @foreach($lesson->questions as $index => $question)
                <div x-show="currentQuestionIndex === {{ $index }}" style="display:none;" x-transition.opacity.duration.300ms>
                    <div class="prose prose-lg max-w-none text-on-surface mb-8">
                        {!! Str::markdown($question->question_text) !!}
                    </div>

                    <div class="space-y-3">
                        @foreach($question->options as $option)
                        <label class="flex items-center p-4 border border-surface-container-high rounded-2xl cursor-pointer hover:border-primary/50 transition-colors group"
                               :class="answers[{{ $question->id }}] == {{ $option->id }} ? 'bg-primary/5 border-primary ring-1 ring-primary' : 'bg-surface-container-lowest'">
                            <input type="radio" 
                                   name="answers[{{ $question->id }}]" 
                                   value="{{ $option->id }}" 
                                   x-model="answers[{{ $question->id }}]"
                                   class="w-5 h-5 text-primary border-surface-container-highest focus:ring-primary focus:ring-offset-surface cursor-pointer">
                            <span class="ml-4 font-bold text-on-surface/90 group-hover:text-on-surface transition-colors">{{ $option->option_text }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="mt-12 flex justify-between items-center pt-8 border-t border-surface-container-high">
                    <button type="button" @click="currentQuestionIndex--" x-show="currentQuestionIndex > 0" class="px-6 py-3 rounded-full border border-surface-container-higher text-on-surface font-black uppercase text-xs hover:bg-surface-container-high transition-colors tracking-widest hidden md:block">
                        Sebelumnya
                    </button>
                    <!-- Spacer if button is hidden -->
                    <div x-show="currentQuestionIndex === 0"></div>

                    <button type="button" @click="currentQuestionIndex++" x-show="currentQuestionIndex < questions.length - 1" class="px-8 py-3 rounded-full bg-primary text-white font-black uppercase text-xs hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20 tracking-widest">
                        Selanjutnya
                    </button>

                    <button type="button" @click="submitForm" x-show="currentQuestionIndex === questions.length - 1" class="px-8 py-3 rounded-full bg-green-500 text-white font-black uppercase text-xs hover:scale-105 active:scale-95 transition-all shadow-xl shadow-green-500/20 tracking-widest flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Serahkan Jawaban
                    </button>
                </div>
            </div>
        </form>
    </template>
    
    <!-- Empty State -->
    @if($lesson->questions->isEmpty())
    <div class="p-12 text-center border overflow-hidden rounded-3xl border-dashed border-surface-container-high">
        <i data-lucide="ghost" class="w-12 h-12 text-tertiary mx-auto mb-4 opacity-50"></i>
        <div class="font-bold text-on-surface tracking-tight">Kuis Belum Memiliki Soal</div>
        <p class="text-tertiary text-sm mt-1">Sistem gagal memuat pertanyaan. Silakan hubungi instruktur.</p>
    </div>
    @endif
</div>
