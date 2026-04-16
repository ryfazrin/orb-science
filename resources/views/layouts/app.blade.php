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
                    Pathway
                </a>
                <a href="/article" class="flex items-center text-sm font-semibold tracking-tight transition-colors {{ Request::is('article*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Articles
                </a>
                <a href="/pricing" class="flex items-center text-sm font-semibold tracking-tight transition-colors {{ Request::is('pricing*') ? 'text-primary' : 'text-tertiary hover:text-on-surface' }}">
                    Pricing <span class="ml-2 flex items-center px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-600 text-[9px] uppercase font-black">Soon</span>
                </a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 px-3 py-1.5 rounded-full font-bold text-tertiary hover:bg-surface-container-low transition-colors outline-none focus:ring-2 focus:ring-primary/20">
                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                <span class="text-sm font-black">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:inline text-sm whitespace-nowrap overflow-hidden text-ellipsis max-w-[120px]">{{ explode(' ', auth()->user()->name ?? 'User')[0] }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             style="display: none;"
                             class="absolute right-0 mt-3 w-52 bg-white border border-surface-container shadow-[0px_8px_32px_rgba(27,28,28,0.1)] rounded-2xl overflow-hidden py-2 z-50">
                            
                            <!-- Dropdown Header Info -->
                            <div class="px-4 py-3 border-b border-surface-container bg-surface-container-low/50">
                                <p class="text-sm font-bold text-on-surface truncate">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-xs font-medium text-tertiary truncate">{{ auth()->user()->email ?? '' }}</p>
                            </div>

                            <!-- Links -->
                            <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-tertiary hover:bg-surface-container-low hover:text-primary transition-colors">
                                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dasbor Utama
                            </a>
                            
                            <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-tertiary hover:bg-surface-container-low hover:text-primary transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i> Pengaturan Profil
                            </a>
                            
                            <div class="h-[1px] w-full bg-surface-container my-1"></div>
                            
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar (Log Out)
                                </button>
                            </form>
                        </div>
                    </div>
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
