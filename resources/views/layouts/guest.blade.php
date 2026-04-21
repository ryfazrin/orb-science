<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ilmu Komputer') }}</title>

    <!-- Vite CSS and JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-surface text-on-surface font-sans antialiased min-h-screen">

    <!-- Minimal Header -->
    <header class="sticky top-0 z-50 w-full bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="text-primary">
                    <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tighter text-primary">Ilmu Komputer</span>
            </a>
            <a href="/" class="flex items-center gap-2 text-sm font-semibold text-tertiary hover:text-on-surface transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-80px)] flex items-center justify-center px-4 py-12">
        {{ $slot }}
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
