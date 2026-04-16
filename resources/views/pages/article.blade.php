@extends('layouts.app')

@section('content')
<div class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

    {{-- Hero --}}
    <header class="mb-14">
        <span class="inline-block px-4 py-1.5 mb-4 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest">
            Blog & Wawasan
        </span>
        <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface leading-[0.9] mb-4">
            Artikel & <span class="text-primary">Perspektif</span>
        </h1>
        <p class="text-lg text-tertiary max-w-2xl">Literasi teknologi gratis dari para praktisi. Pelajaran mendalam, tutorial, dan wawasan industri terbaru.</p>
    </header>

    {{-- Search + Filter --}}
    <form method="GET" action="{{ url('/article') }}" class="mb-12 flex flex-col sm:flex-row gap-4">
        <div class="relative flex-grow">
            <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-tertiary"></i>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Cari artikel..."
                   class="w-full pl-12 pr-5 py-3.5 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 outline-none font-medium">
        </div>
        <select name="category"
                onchange="this.form.submit()"
                class="px-5 py-3.5 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 outline-none font-bold text-sm appearance-none cursor-pointer min-w-[180px]">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                {{ $cat->name }} ({{ $cat->articles_count }})
            </option>
            @endforeach
        </select>
        @if(request()->hasAny(['q', 'category']))
        <a href="{{ url('/article') }}" class="px-5 py-3.5 rounded-full border border-surface-container-high text-tertiary font-bold text-sm hover:bg-surface-container-high transition-all flex items-center gap-2">
            <i data-lucide="x" class="w-4 h-4"></i> Reset
        </a>
        @endif
    </form>

    @if($articles->isEmpty())
    <div class="text-center py-24 border border-dashed border-surface-container-high rounded-3xl">
        <i data-lucide="file-search" class="w-16 h-16 text-tertiary mx-auto mb-4 opacity-40"></i>
        <p class="font-black text-xl text-on-surface">Artikel Tidak Ditemukan</p>
        <p class="text-tertiary mt-2">Coba kata kunci atau kategori yang berbeda.</p>
    </div>
    @else

    {{-- Featured Article (jika halaman 1 dan tidak ada filter) --}}
    @if($featured && $articles->currentPage() === 1 && !request()->hasAny(['q', 'category']))
    <a href="{{ url('/article/' . $featured->slug) }}"
       class="group mb-12 flex flex-col lg:flex-row bg-surface-container-lowest rounded-[2.5rem] border border-surface-container-high overflow-hidden hover:shadow-xl hover:shadow-black/5 hover:scale-[1.005] transition-all duration-300 block">
        <div class="lg:w-1/2 aspect-video lg:aspect-auto overflow-hidden bg-surface-container-high">
            @if($featured->thumbnail)
            <img src="{{ Storage::url($featured->thumbnail) }}" alt="{{ $featured->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
            <div class="w-full h-full min-h-64 bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                <i data-lucide="file-text" class="w-16 h-16 text-primary/30"></i>
            </div>
            @endif
        </div>
        <div class="flex-1 p-10 flex flex-col justify-center">
            <div class="flex items-center gap-3 mb-5">
                @if($featured->category)
                <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest"
                      style="background-color: {{ $featured->category->color ?? '#6c63ff' }}1a; color: {{ $featured->category->color ?? '#6c63ff' }};">
                    {{ $featured->category->name }}
                </span>
                @endif
                <span class="text-tertiary text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i> {{ $featured->reading_time }} menit baca
                </span>
                <span class="ml-auto text-xs font-black uppercase tracking-widest text-primary border border-primary/20 px-2 py-0.5 rounded-full">Featured</span>
            </div>
            <h2 class="text-3xl font-black tracking-tight text-on-surface group-hover:text-primary transition-colors mb-4 leading-tight">{{ $featured->title }}</h2>
            @if($featured->excerpt)
            <p class="text-tertiary font-medium leading-relaxed mb-6">{{ Str::limit($featured->excerpt, 150) }}</p>
            @endif
            <div class="flex items-center gap-3 mt-auto">
                <div class="w-9 h-9 rounded-full overflow-hidden bg-surface-container-high">
                    @if($featured->author?->avatar_url)
                    <img src="{{ Storage::url($featured->author->avatar_url) }}" alt="{{ $featured->author->name }}" class="w-full h-full object-cover">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($featured->author?->name ?? 'A') }}&size=64&background=random&bold=true" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <p class="text-sm font-black text-on-surface">{{ $featured->author?->name }}</p>
                    <p class="text-xs text-tertiary">{{ $featured->published_at?->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </a>
    @endif

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">
        @foreach($articles as $article)
        @if($article->id === ($featured->id ?? null) && $articles->currentPage() === 1 && !request()->hasAny(['q', 'category']))
        @continue
        @endif
        <a href="{{ url('/article/' . $article->slug) }}"
           class="group flex flex-col bg-surface-container-lowest rounded-[2rem] border border-surface-container-high overflow-hidden hover:shadow-lg hover:shadow-black/5 hover:scale-[1.01] transition-all duration-300">
            <div class="aspect-video overflow-hidden bg-surface-container-high">
                @if($article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-primary/10 to-surface-container flex items-center justify-center">
                    <i data-lucide="file-text" class="w-10 h-10 text-primary/20"></i>
                </div>
                @endif
            </div>
            <div class="p-7 flex flex-col flex-grow">
                <div class="flex items-center gap-2 mb-4">
                    @if($article->category)
                    <span class="px-2.5 py-1 rounded-full text-xs font-black uppercase tracking-widest"
                          style="background-color: {{ $article->category->color ?? '#6c63ff' }}1a; color: {{ $article->category->color ?? '#6c63ff' }};">
                        {{ $article->category->name }}
                    </span>
                    @endif
                    <span class="text-tertiary text-xs flex items-center gap-1 ml-auto">
                        <i data-lucide="clock" class="w-3 h-3"></i> {{ $article->reading_time }} min
                    </span>
                </div>
                <h3 class="text-lg font-black tracking-tight text-on-surface group-hover:text-primary transition-colors leading-snug mb-3 flex-grow">
                    {{ $article->title }}
                </h3>
                @if($article->excerpt)
                <p class="text-tertiary text-sm leading-relaxed mb-5 line-clamp-2">{{ $article->excerpt }}</p>
                @endif
                <div class="flex items-center gap-3 pt-5 border-t border-surface-container-high">
                    <div class="w-7 h-7 rounded-full overflow-hidden bg-surface-container-high shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author?->name ?? 'A') }}&size=56&background=random&bold=true" class="w-full h-full object-cover">
                    </div>
                    <span class="text-xs font-bold text-tertiary">{{ $article->author?->name }}</span>
                    <span class="text-xs text-tertiary ml-auto">{{ $article->published_at?->format('d M Y') }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($articles->hasPages())
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
    @endif

    @endif
</div>
@endsection
