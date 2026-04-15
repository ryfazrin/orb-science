<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ilmu Komputer</title>

    <!-- Vite CSS and JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-surface text-on-surface font-sans antialiased min-h-screen flex flex-col">

    <!-- Header -->
    <header class="sticky top-0 z-50 w-full bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="text-primary">
                    <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-black tracking-tighter text-primary">Ilmu Komputer</h1>
            </a>

            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="text-sm font-semibold tracking-tight transition-colors {{ Request::is('/') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Home
                </a>
                <a href="/catalog" class="text-sm font-semibold tracking-tight transition-colors {{ Request::is('catalog*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Catalog
                </a>
                <a href="/pathway" class="flex items-center text-sm font-semibold tracking-tight transition-colors {{ Request::is('pathway*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Pathway <span class="ml-2 flex items-center px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[9px] uppercase font-black">Soon</span>
                </a>
                <a href="/article" class="flex items-center text-sm font-semibold tracking-tight transition-colors {{ Request::is('article*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Articles <span class="ml-2 flex items-center px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[9px] uppercase font-black">Soon</span>
                </a>
                <a href="/pricing" class="flex items-center text-sm font-semibold tracking-tight transition-colors {{ Request::is('pricing*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Pricing <span class="ml-2 flex items-center px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[9px] uppercase font-black">Soon</span>
                </a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <a href="/profile" class="flex items-center gap-2 px-4 py-2 rounded-full font-bold text-tertiary hover:bg-surface-container-low transition-colors">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Profile</span>
                        <span class="px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[9px] uppercase font-black ml-1">Soon</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-full font-bold bg-primary text-white shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Log Out</span>
                        </button>
                    </form>
                @else
                    <a href="/login" class="flex items-center gap-2 px-4 py-2 rounded-full font-bold text-tertiary hover:bg-surface-container-low transition-colors">
                        <i data-lucide="log-in" class="w-[18px] h-[18px]"></i>
                        <span class="hidden sm:inline">Log In</span>
                    </a>
                    <a href="/register" class="flex items-center gap-2 px-4 py-2 rounded-full font-bold bg-primary text-white shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
                        <span class="hidden sm:inline">Register</span>
                    </a>
                @endauth

                <button class="md:hidden p-2 text-tertiary">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    @if(!Request::is('course/*/learn/*'))
    <footer class="bg-surface-container-low py-12 border-t border-surface-container-high">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex flex-col items-center md:items-start gap-2">
                    <span class="font-bold text-xl text-on-surface">Ilmu Komputer</span>
                    <p class="text-sm text-tertiary">© 2026 Ilmu Komputer. Curating the future of CS.</p>
                </div>
                <div class="flex gap-8">
                    <a href="/support" class="text-sm font-medium text-tertiary hover:text-primary transition-colors">Contact</a>
                    <a href="/about" class="text-sm font-medium text-tertiary hover:text-primary transition-colors">About</a>
                    <a href="/support" class="text-sm font-medium text-tertiary hover:text-primary transition-colors">Support</a>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
