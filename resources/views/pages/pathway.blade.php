@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Hero Header -->
    <header class="mb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1.5 mb-4 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest">
                    Your Path
                </span>
                <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface mb-4 leading-[0.9]">
                    Your Personalized <span class="text-primary">Learning Journey</span>
                </h1>
                <p class="text-lg text-tertiary font-medium">
                    A curated roadmap based on your interests in <span class="text-on-surface font-black">Web Development</span> and <span class="text-on-surface font-black">AI</span>.
                </p>
            </div>
            <div class="bg-surface-container-lowest p-8 rounded-[2.5rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)] min-w-[320px] border border-surface-container-high">
                <div class="flex justify-between items-end mb-3">
                    <span class="text-xs font-black text-tertiary uppercase tracking-widest">Overall Progress</span>
                    <span class="text-3xl font-black text-primary tracking-tighter">34%</span>
                </div>
                <div class="w-full bg-surface-container-high h-3 rounded-full overflow-hidden">
                    <div class="bg-primary h-full rounded-full transition-all duration-1000" style="width: 34%;"></div>
                </div>
                <p class="mt-4 text-xs text-tertiary font-bold italic uppercase tracking-widest">2 of 6 modules completed</p>
            </div>
        </div>
    </header>

    <!-- Learning Timeline -->
    <div class="relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Timeline Column -->
            <div class="lg:col-span-8 flex flex-col gap-12">
                
                <!-- Module 1: Completed -->
                <div class="group relative flex gap-8 md:gap-12">
                    <div class="flex flex-col items-center">
                        <div class="z-10 flex items-center justify-center w-14 h-14 rounded-full bg-primary text-white shadow-2xl shadow-primary/20 ring-8 ring-surface">
                            <i data-lucide="check-circle" class="w-6 h-6 text-white fill-current"></i>
                        </div>
                        <div class="h-full w-1 bg-primary/20 absolute top-14 left-7 -ml-0.5"></div>
                    </div>
                    <div class="flex-1 bg-surface-container-lowest p-8 rounded-[2.5rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)] border border-surface-container-high transition-all hover:scale-[1.01]">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                            <div>
                                <span class="text-xs font-black text-primary uppercase tracking-widest mb-2 block">Module 01</span>
                                <h3 class="text-2xl font-black tracking-tight text-on-surface">Fundamentals of Programming</h3>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-surface-container-low text-tertiary text-xs font-black uppercase tracking-widest">
                                <i data-lucide="clock" class="w-3.5 h-3.5 mr-2"></i> 4 hours
                            </span>
                        </div>
                        <p class="text-tertiary mb-8 max-w-lg font-medium leading-relaxed">
                            Master the core concepts of logic, variables, and control flow that form the backbone of all engineering.
                        </p>
                        <div class="flex items-center justify-between pt-6 border-t border-surface-container-high">
                            <div class="flex items-center gap-2 text-xs font-black text-primary uppercase tracking-widest">
                                <i data-lucide="check-circle" class="w-4 h-4"></i>
                                <span>COMPLETED</span>
                            </div>
                            <a href="/course/1" class="text-primary font-black text-xs uppercase tracking-widest flex items-center gap-2 hover:underline">
                                Review Content <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Module 2: In Progress -->
                <div class="group relative flex gap-8 md:gap-12">
                    <div class="flex flex-col items-center">
                        <div class="z-10 flex items-center justify-center w-14 h-14 rounded-full bg-white text-primary shadow-2xl shadow-primary/10 ring-8 ring-surface border-2 border-primary animate-pulse">
                            <i data-lucide="play-circle" class="w-6 h-6 fill-current"></i>
                        </div>
                        <div class="h-full w-1 bg-surface-container-high absolute top-14 left-7 -ml-0.5"></div>
                    </div>
                    <div class="flex-1 bg-surface-container-lowest p-8 rounded-[2.5rem] shadow-[0px_8px_32px_rgba(188,1,0,0.08)] border-2 border-primary/20 transition-all hover:scale-[1.01]">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                            <div>
                                <span class="text-xs font-black text-primary uppercase tracking-widest mb-2 block">Module 02</span>
                                <h3 class="text-2xl font-black tracking-tight text-on-surface">Advanced JavaScript Patterns</h3>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest">
                                <i data-lucide="clock" class="w-3.5 h-3.5 mr-2"></i> 6 hours
                            </span>
                        </div>
                        <p class="text-tertiary mb-8 max-w-lg font-medium leading-relaxed">
                            Deep dive into closures, asynchronous programming, and functional paradigms for high-performance apps.
                        </p>
                        <div class="mb-8">
                            <div class="flex justify-between text-xs font-black mb-3 text-tertiary uppercase tracking-widest">
                                <span>Current Progress</span>
                                <span>65%</span>
                            </div>
                            <div class="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
                                <div class="bg-primary h-full rounded-full" style="width: 65%;"></div>
                            </div>
                        </div>
                        <a 
                            href="/lesson/1"
                            class="inline-block w-full md:w-auto px-10 py-4 text-center bg-primary text-white font-black rounded-full shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all"
                        >
                            Continue Learning
                        </a>
                    </div>
                </div>

                <!-- Module 3: Locked -->
                <div class="group relative flex gap-8 md:gap-12 opacity-60">
                    <div class="flex flex-col items-center">
                        <div class="z-10 flex items-center justify-center w-14 h-14 rounded-full bg-surface-container-high text-tertiary ring-8 ring-surface">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div class="h-full w-1 bg-surface-container-high absolute top-14 left-7 -ml-0.5"></div>
                    </div>
                    <div class="flex-1 bg-surface-container-low p-8 rounded-[2.5rem] border border-surface-container-high transition-all">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                            <div>
                                <span class="text-xs font-black text-tertiary uppercase tracking-widest mb-2 block">Module 03</span>
                                <h3 class="text-2xl font-black tracking-tight text-on-surface">Building with React & Next.js</h3>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-surface-container-high text-tertiary text-xs font-black uppercase tracking-widest">
                                <i data-lucide="clock" class="w-3.5 h-3.5 mr-2"></i> 8 hours
                            </span>
                        </div>
                        <p class="text-tertiary mb-8 max-w-lg font-medium leading-relaxed">
                            The modern web stack. Learn component architecture, server-side rendering, and state management.
                        </p>
                        <div class="flex items-center gap-2 text-xs font-black text-tertiary uppercase tracking-widest">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            <span>Complete Module 02 to unlock</span>
                        </div>
                    </div>
                </div>

                <!-- Module 4: Locked (Illustration Variant) -->
                <div class="group relative flex gap-8 md:gap-12 opacity-50">
                    <div class="flex flex-col items-center">
                        <div class="z-10 flex items-center justify-center w-14 h-14 rounded-full bg-surface-container-high text-tertiary ring-8 ring-surface">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="flex-1 bg-surface-container-low p-8 rounded-[2.5rem] flex flex-col md:flex-row items-center gap-8 border border-surface-container-high">
                        <div class="w-full md:w-40 h-40 rounded-3xl bg-surface-container-high overflow-hidden flex-shrink-0">
                            <img 
                                alt="AI concept" 
                                class="w-full h-full object-cover grayscale" 
                                src="https://picsum.photos/seed/ai-path/400/400"
                                referrerpolicy="no-referrer"
                            />
                        </div>
                        <div class="flex-1">
                            <span class="text-xs font-black text-tertiary uppercase tracking-widest mb-2 block">Module 04</span>
                            <h3 class="text-2xl font-black tracking-tight text-on-surface">Introduction to Generative AI</h3>
                            <p class="text-tertiary mt-3 font-medium leading-relaxed">Integrating LLMs and diffusion models into your web applications.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar / Recommendations -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Instructor Card -->
                <div class="bg-surface-container-low p-8 rounded-[2.5rem] border border-surface-container-high">
                    <h4 class="text-xl font-black tracking-tight mb-8 text-on-surface">Path Curators</h4>
                    <div class="space-y-8">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-surface-container-high">
                                <img alt="Instructor" class="w-full h-full object-cover" src="https://picsum.photos/seed/curator1/100/100" referrerpolicy="no-referrer" />
                            </div>
                            <div>
                                <p class="font-black text-on-surface leading-tight">Dr. Elias Thorne</p>
                                <p class="text-xs text-tertiary font-black uppercase tracking-widest mt-1">Head of AI Research</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-surface-container-high">
                                <img alt="Instructor" class="w-full h-full object-cover" src="https://picsum.photos/seed/curator2/100/100" referrerpolicy="no-referrer" />
                            </div>
                            <div>
                                <p class="font-black text-on-surface leading-tight">Sarah Jenkins</p>
                                <p class="text-xs text-tertiary font-black uppercase tracking-widest mt-1">Sr. Frontend Engineer</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-10 py-4 text-primary border-2 border-primary/20 font-black rounded-full hover:bg-primary/5 transition-all uppercase tracking-widest text-xs">
                        Ask a Question
                    </button>
                </div>

                <!-- Recommended Tool -->
                <div class="bg-on-surface text-surface p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <i data-lucide="zap" class="text-primary mb-6 group-hover:scale-110 transition-transform w-8 h-8 fill-current"></i>
                        <h4 class="text-2xl font-black tracking-tight mb-3">Clarity Workspace</h4>
                        <p class="text-surface/70 text-sm mb-8 leading-relaxed font-medium">
                            Access our cloud-based IDE pre-configured with all the libraries needed for this path.
                        </p>
                        <button class="w-full py-4 bg-surface text-on-surface font-black rounded-full hover:scale-105 active:scale-95 transition-all uppercase tracking-widest text-xs">
                            Launch IDE
                        </button>
                    </div>
                    <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:scale-110 transition-transform duration-700">
                        <i data-lucide="zap" class="w-[200px] h-[200px]"></i>
                    </div>
                </div>

                <!-- Community Badge -->
                <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-[0px_4px_24px_rgba(27,28,28,0.06)] flex items-center gap-4 border border-surface-container-high">
                    <div class="flex -space-x-3">
                        @foreach([1, 2, 3] as $i)
                        <div class="w-10 h-10 rounded-full border-4 border-surface bg-surface-container-high overflow-hidden">
                            <img src="https://picsum.photos/seed/user{{ $i }}/40/40" alt="User" referrerpolicy="no-referrer" />
                        </div>
                        @endforeach
                    </div>
                    <p class="text-sm font-medium text-tertiary">
                        <span class="text-on-surface font-black">1.2k others</span> are on this path
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
