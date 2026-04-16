@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

    {{-- Hero --}}
    <header class="mb-16">
        <span class="inline-block px-4 py-1.5 mb-4 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest">
            Learning Paths
        </span>
        <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-on-surface mb-4 leading-[0.9]">
            Pilih <span class="text-primary">Jalur Karir</span> Anda
        </h1>
        <p class="text-lg text-tertiary font-medium max-w-2xl">
            Kurikulum berjenjang yang dirancang oleh para praktisi industri. Dari nol hingga siap kerja, satu jalur pada satu waktu.
        </p>
    </header>

    @if($pathways->isEmpty())
    <div class="text-center py-24 border border-dashed border-surface-container-high rounded-3xl">
        <i data-lucide="map" class="w-16 h-16 text-tertiary mx-auto mb-4 opacity-40"></i>
        <p class="font-black text-xl text-on-surface">Belum Ada Learning Path</p>
        <p class="text-tertiary mt-2">Admin belum menambahkan jalur karir. Silakan cek kembali nanti.</p>
    </div>
    @else

    {{-- Grid Pathway Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($pathways as $pathway)
        @php
            $totalCourses = $pathway->levels->flatMap->courses->count();
            $totalMinutes = $pathway->levels->flatMap->courses->sum('duration_minutes');
            $totalHours   = $totalMinutes > 0 ? round($totalMinutes / 60, 1) : 0;
            $levelCount   = $pathway->levels->count();
        @endphp
        <a href="{{ url('/pathway/' . $pathway->slug) }}"
           class="group bg-surface-container-lowest rounded-[2.5rem] border border-surface-container-high overflow-hidden hover:shadow-xl hover:shadow-black/5 hover:scale-[1.01] transition-all duration-300 flex flex-col">

            {{-- Color Banner --}}
            <div class="h-3 w-full" style="background-color: {{ $pathway->color ?? '#6c63ff' }};"></div>

            <div class="p-8 flex flex-col flex-grow">
                {{-- Icon + Title --}}
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0"
                         style="background-color: {{ $pathway->color ?? '#6c63ff' }}1a;">
                        <i data-lucide="{{ $pathway->icon ?? 'map' }}" class="w-7 h-7"
                           style="color: {{ $pathway->color ?? '#6c63ff' }};"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black tracking-tight text-on-surface leading-tight group-hover:text-primary transition-colors">
                            {{ $pathway->title }}
                        </h2>
                        <div class="flex items-center gap-1 mt-1">
                            @for($i = 0; $i < $levelCount; $i++)
                            <div class="h-1.5 w-6 rounded-full"
                                 style="background-color: {{ $pathway->color ?? '#6c63ff' }}{{ $i === 0 ? 'ff' : ($i === 1 ? '88' : '44') }};"></div>
                            @endfor
                            @for($i = $levelCount; $i < 3; $i++)
                            <div class="h-1.5 w-6 rounded-full bg-surface-container-high"></div>
                            @endfor
                            <span class="text-xs text-tertiary ml-1 font-bold">{{ $levelCount }} Level</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if($pathway->description)
                <p class="text-tertiary font-medium text-sm leading-relaxed mb-6 flex-grow">
                    {{ Str::limit($pathway->description, 120) }}
                </p>
                @else
                <div class="flex-grow"></div>
                @endif

                {{-- Stats --}}
                <div class="flex items-center gap-4 pt-6 border-t border-surface-container-high text-xs font-black uppercase tracking-widest text-tertiary">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                        {{ $totalCourses }} Kursus
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        {{ $totalHours }} Jam
                    </span>
                    <span class="ml-auto flex items-center gap-1 text-primary group-hover:gap-2 transition-all">
                        Lihat Jalur <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
