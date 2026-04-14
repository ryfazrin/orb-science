@extends('layouts.app')

@section('content')
<!-- We use AlpineJS to handle the sidebar toggle state -->
<div class="flex min-h-[calc(100vh-5rem)] bg-surface relative" x-data="{ isSidebarOpen: true, activeSection: 'module-{{ $currentLesson->module_id }}' }">
    <!-- Main Content Area -->
    <div class="flex-1 transition-all duration-300" :class="isSidebarOpen ? 'xl:mr-96' : ''">
        <div class="px-6 lg:px-20 py-12 max-w-5xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary mb-8">
                <a href="/catalog" class="hover:text-primary cursor-pointer">Courses</a>
                <i data-lucide="chevron-right" class="w-2.5 h-2.5"></i>
                <a href="/course/{{ $course->id }}" class="hover:text-primary cursor-pointer">{{ $course->title }}</a>
                <i data-lucide="chevron-right" class="w-2.5 h-2.5"></i>
                <span class="text-primary">{{ $currentLesson->title }}</span>
            </nav>

            <article class="space-y-12">
                <div class="space-y-6">
                    <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface leading-[0.9]">
                        {{ $currentLesson->title }}
                    </h1>
                    <p class="text-xl text-tertiary leading-relaxed max-w-3xl font-medium">
                        A singly linked list is a linear data structure where each element is a separate object, called a node. Each node contains data and a reference to the next node in the sequence.
                    </p>
                </div>

                <!-- Video Player Placeholder -->
                <div class="relative group aspect-video rounded-[2.5rem] overflow-hidden bg-on-surface shadow-2xl">
                    <img 
                        alt="Video Placeholder" 
                        class="w-full h-full object-cover opacity-40 group-hover:scale-105 transition-transform duration-700" 
                        src="https://picsum.photos/seed/linkedlist/1200/800"
                        referrerpolicy="no-referrer"
                    />
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-2xl shadow-primary/40 group/btn">
                            <i data-lucide="play" class="w-10 h-10 ml-2 fill-current"></i>
                        </button>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 to-transparent">
                        <p class="text-white text-xl font-black tracking-tight">Lecture 4.2: Traversing the Chain</p>
                        <p class="text-white/60 text-sm font-bold uppercase tracking-widest mt-1">12:45 minutes</p>
                    </div>
                </div>

                <!-- Reading Section -->
                <div class="prose prose-lg max-w-none text-on-surface/90 leading-relaxed space-y-8">
                    <h2 class="text-3xl font-black tracking-tight text-on-surface">The Anatomy of a Node</h2>
                    <p class="text-lg">
                        In a singly linked list, each node is composed of two items: the <strong class="text-primary">data</strong> and a <strong class="text-primary">next</strong> pointer. This differs from arrays, which occupy a contiguous block of memory. Nodes in a linked list can be scattered throughout memory, connected only by their pointers.
                    </p>

                    <!-- Pros & Cons Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-12">
                        <div class="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high">
                            <h3 class="text-xl font-black tracking-tight mb-6 text-primary uppercase tracking-widest">Pros</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <i data-lucide="check-circle" class="text-green-600 mt-1 flex-shrink-0 w-5 h-5"></i>
                                    <span class="font-medium">Dynamic size: Grows or shrinks as needed during execution.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i data-lucide="check-circle" class="text-green-600 mt-1 flex-shrink-0 w-5 h-5"></i>
                                    <span class="font-medium">Ease of Insertion/Deletion: No shifting elements required.</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-surface-container-high p-8 rounded-[2rem]">
                            <h3 class="text-xl font-black tracking-tight mb-6 text-on-surface uppercase tracking-widest">Cons</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <i data-lucide="x-circle" class="text-red-500 mt-1 flex-shrink-0 w-5 h-5"></i>
                                    <span class="font-medium">Random access is not allowed: Must traverse from head.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i data-lucide="x-circle" class="text-red-500 mt-1 flex-shrink-0 w-5 h-5"></i>
                                    <span class="font-medium">Extra memory space: For pointer storage in each node.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p class="text-lg">
                        Linked lists are particularly useful when you don't know the number of elements in advance or when you need to perform frequent insertions and deletions. However, they come with the trade-off of slower access times for specific elements compared to arrays.
                    </p>

                    <div class="rounded-[2.5rem] overflow-hidden my-12 shadow-xl bg-surface-container-lowest p-8 border border-surface-container-high">
                        <img 
                            class="w-full h-auto rounded-2xl mb-6" 
                            src="https://picsum.photos/seed/code/1200/600"
                            alt="Code Visualization"
                            referrerpolicy="no-referrer"
                        />
                        <p class="text-center text-sm text-tertiary font-bold italic">Visualizing memory allocation in dynamic structures.</p>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Sidebar - Course Content -->
    <aside class="hidden xl:flex h-[calc(100vh-5rem)] w-96 fixed right-0 top-20 bg-surface-container-low border-l border-surface-container-high flex-col p-8 gap-y-8 overflow-y-auto transition-transform duration-300"
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
            <div class="{{ $currentLesson->module_id == $module->id ? 'bg-surface-container-lowest shadow-sm' : 'bg-surface-container-high/30 hover:border-surface-container-high' }} rounded-3xl p-6 border border-transparent transition-all">
                <button 
                    @click="activeSection = (activeSection === 'module-{{ $module->id }}' ? '' : 'module-{{ $module->id }}')"
                    class="flex items-center justify-between w-full font-black tracking-tight {{ $currentLesson->module_id == $module->id ? 'text-primary' : 'text-on-surface opacity-60' }}"
                >
                    <span class="flex items-center gap-3">
                        <i data-lucide="network" class="w-[18px] h-[18px]"></i>
                        {{ $module->title }}
                    </span>
                    <i data-lucide="chevron-up" x-show="activeSection === 'module-{{ $module->id }}'" class="w-5 h-5"></i>
                    <i data-lucide="chevron-down" x-show="activeSection !== 'module-{{ $module->id }}'" style="display:none;" class="w-5 h-5"></i>
                </button>
                <div x-show="activeSection === 'module-{{ $module->id }}'" class="mt-6 space-y-4" style="{{ $currentLesson->module_id == $module->id ? '' : 'display:none;' }}">
                    @foreach($module->lessons as $lessonItem)
                    @php
                        $isCompleted = in_array($lessonItem->id, $completedLessonIds);
                    @endphp
                    <a href="/course/{{ $course->id }}/learn/{{ $lessonItem->id }}" class="flex items-center gap-3 text-sm transition-colors group {{ $currentLesson->id == $lessonItem->id ? 'font-black text-primary' : 'font-bold text-tertiary hover:text-on-surface' }}">
                        @if($isCompleted)
                        <i data-lucide="check-circle" class="text-green-500 w-5 h-5 flex-shrink-0"></i>
                        @elseif($currentLesson->id == $lessonItem->id)
                        <div class="w-4 h-4 rounded-full border-2 border-primary flex items-center justify-center flex-shrink-0 ml-0.5">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                        </div>
                        @else
                        <div class="w-4 h-4 rounded-full border-2 border-surface-container-high flex-shrink-0 ml-0.5"></div>
                        @endif
                        <span>{{ $lessonItem->title }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <button class="w-full py-4 rounded-2xl bg-on-surface text-surface font-black tracking-tight hover:bg-on-surface/90 transition-all shadow-xl">
            View Certificate
        </button>
    </aside>

    <!-- Bottom Navigation Bar -->
    <footer class="fixed bottom-0 left-0 w-full h-24 z-50 bg-surface/90 backdrop-blur-xl border-t border-surface-container-high flex justify-between items-center px-8 lg:px-12 py-4 shadow-[0_-4px_24px_rgba(0,0,0,0.04)]"
            :class="isSidebarOpen ? 'xl:pr-[416px]' : ''">
        <a 
            href="/dashboard"
            class="flex items-center gap-2 px-6 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-low transition-all active:scale-95"
        >
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back
        </a>
        
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

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
