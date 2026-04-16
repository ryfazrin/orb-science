@extends('layouts.app')

@section('content')
<div class="py-20 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary mb-10">
        <a href="/article" class="hover:text-primary transition-colors">Artikel</a>
        @if($article->category)
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <a href="/article?category={{ $article->category->slug }}" class="hover:text-primary transition-colors"
           style="color: {{ $article->category->color ?? '#6c63ff' }};">
            {{ $article->category->name }}
        </a>
        @endif
    </nav>

    {{-- Article Header --}}
    <div class="mb-12">
        <div class="flex flex-wrap items-center gap-3 mb-6">
            @if($article->category)
            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest"
                  style="background-color: {{ $article->category->color ?? '#6c63ff' }}1a; color: {{ $article->category->color ?? '#6c63ff' }};">
                {{ $article->category->name }}
            </span>
            @endif
            <span class="text-tertiary text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                <i data-lucide="clock" class="w-3.5 h-3.5"></i> {{ $article->reading_time }} menit baca
            </span>
            <span class="text-tertiary text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
            </span>
        </div>

        <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-[0.9] text-on-surface mb-8">
            {{ $article->title }}
        </h1>

        @if($article->excerpt)
        <p class="text-xl text-tertiary font-medium leading-relaxed border-l-4 border-primary pl-6 py-2 mb-8">
            {{ $article->excerpt }}
        </p>
        @endif

        {{-- Author Bar --}}
        <div class="flex items-center justify-between py-6 border-y border-surface-container-high">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container-high">
                    @if($article->author?->avatar_url)
                    <img src="{{ Storage::url($article->author->avatar_url) }}" alt="{{ $article->author->name }}" class="w-full h-full object-cover">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author?->name ?? 'A') }}&size=96&background=random&bold=true" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h4 class="font-black text-on-surface leading-none mb-1">{{ $article->author?->name }}</h4>
                    @if($article->author?->bio)
                    <p class="text-xs text-tertiary font-medium">{{ Str::limit($article->author->bio, 60) }}</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="navigator.share({title: '{{ addslashes($article->title) }}', url: window.location.href}).catch(()=>{})"
                        class="p-2.5 text-tertiary hover:text-primary hover:bg-surface-container-high rounded-full transition-all">
                    <i data-lucide="share-2" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Thumbnail --}}
    @if($article->thumbnail)
    <div class="mb-12 rounded-[2.5rem] overflow-hidden aspect-video shadow-2xl">
        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
             class="w-full h-full object-cover">
    </div>
    @endif

    {{-- Article Content --}}
    <div class="prose prose-lg max-w-none
        prose-headings:font-black prose-headings:tracking-tight
        prose-a:text-primary prose-a:no-underline hover:prose-a:underline
        prose-pre:bg-surface-container-lowest prose-pre:border prose-pre:border-surface-container-high prose-pre:text-on-surface prose-pre:shadow-sm
        prose-blockquote:border-l-4 prose-blockquote:border-primary prose-blockquote:bg-surface-container-high/30 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:rounded-r-2xl prose-blockquote:not-italic prose-blockquote:text-on-surface
        prose-img:rounded-3xl prose-img:shadow-xl
        text-on-surface/90 leading-relaxed">
        {!! Str::markdown($article->content ?? '') !!}
    </div>

    {{-- Tags --}}
    @if($article->tags->isNotEmpty())
    <div class="mt-12 pt-8 border-t border-surface-container-high flex flex-wrap gap-2">
        @foreach($article->tags as $tag)
        <a href="/article?q={{ urlencode($tag->name) }}"
           class="px-4 py-1.5 rounded-full bg-surface-container-high text-on-surface/70 text-xs font-bold hover:bg-primary/10 hover:text-primary transition-all">
            #{{ $tag->name }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- Related Articles --}}
    @if($related->isNotEmpty())
    <div class="mt-20 pt-12 border-t border-surface-container-high">
        <h3 class="text-2xl font-black tracking-tight text-on-surface mb-8">Artikel Terkait</h3>
        <div class="grid grid-cols-1 sm:grid-cols-{{ count($related) >= 2 ? '2' : '1' }} {{ count($related) >= 3 ? 'md:grid-cols-3' : '' }} gap-6">
            @foreach($related as $rel)
            <a href="{{ url('/article/' . $rel->slug) }}"
               class="group flex flex-col bg-surface-container-lowest rounded-[2rem] border border-surface-container-high overflow-hidden hover:shadow-md hover:scale-[1.01] transition-all">
                <div class="aspect-video bg-surface-container-high overflow-hidden">
                    @if($rel->thumbnail)
                    <img src="{{ Storage::url($rel->thumbnail) }}" alt="{{ $rel->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i data-lucide="file-text" class="w-8 h-8 text-primary/20"></i>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h4 class="font-black tracking-tight text-on-surface group-hover:text-primary transition-colors leading-snug">{{ $rel->title }}</h4>
                    <p class="text-xs text-tertiary mt-1">{{ $rel->published_at?->format('d M Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- KaTeX untuk rumus dalam artikel --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"
        onload="renderMathInElement(document.body,{delimiters:[{left:'$$',right:'$$',display:true},{left:'$',right:'$',display:false}]});"></script>
@endsection
