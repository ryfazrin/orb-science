<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $course->title ?? 'Course' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-surface text-on-surface font-sans antialiased min-h-screen flex flex-col">

    <header class="sticky top-0 z-50 w-full bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-xl font-black">{{ $course->title ?? 'Course' }}</h1>
                    @if(isset($course->subtitle) && $course->subtitle)
                    <div class="text-sm text-tertiary">{{ $course->subtitle }}</div>
                    @endif
                </div>
                <div class="hidden md:flex items-center gap-6 text-sm text-tertiary">
                    <div>{{ $course->modules->sum(fn($m) => $m->lessons->count()) ?? ($totalLessons ?? '0') }} Lessons</div>
                    <div>{{ $completedLessonsCount ?? '0' }} completed</div>
                    <div>{{ $progressPercent ?? '0' }}% progress</div>
                </div>
            </div>

            <nav class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2 px-4 py-2 rounded-full font-bold text-tertiary hover:bg-surface-container-low transition-colors">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span class="hidden sm:inline">Kembali ke Home</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        @yield('course-content')
    </main>

    <footer class="bg-surface-container-low py-12 border-t border-surface-container-high mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-tertiary">
            © {{ date('Y') }} {{ config('app.name', 'Ilmu Komputer') }}
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>
