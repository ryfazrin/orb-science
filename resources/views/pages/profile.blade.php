@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

    {{-- Status Flash --}}
    @if(session('status') === 'profile-updated')
    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center gap-3">
        <i data-lucide="check-circle" class="text-green-500 w-5 h-5 shrink-0"></i>
        <span class="font-bold text-green-700">Profil berhasil diperbarui!</span>
    </div>
    @elseif(session('status') === 'avatar-updated')
    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center gap-3">
        <i data-lucide="check-circle" class="text-green-500 w-5 h-5 shrink-0"></i>
        <span class="font-bold text-green-700">Foto profil berhasil diperbarui!</span>
    </div>
    @endif

    {{-- Profile Hero --}}
    <header class="mb-12">
        <h1 class="text-5xl font-black tracking-tighter text-on-surface mb-2">Your Profile</h1>
        <p class="text-lg text-tertiary">Kelola akun dan unduh sertifikat kelulusan Anda.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- ====== LEFT COLUMN ====== --}}
        <div class="lg:col-span-7 space-y-8">

            {{-- Upload Foto Profil --}}
            <section class="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)]">
                <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data"
                      x-data="{
                          previewUrl: '{{ $user->avatar_url ? Storage::url($user->avatar_url) : '' }}',
                          handleFile(e) {
                              const file = e.target.files[0];
                              if (file) this.previewUrl = URL.createObjectURL(file);
                          }
                      }">
                    @csrf
                    <div class="flex items-center gap-6 mb-8">
                        <div class="relative group cursor-pointer" @click="$refs.avatarInput.click()">
                            <div class="w-24 h-24 rounded-full overflow-hidden ring-4 ring-primary/10">
                                <template x-if="previewUrl">
                                    <img :src="previewUrl" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewUrl">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=random&color=fff&bold=true"
                                         alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <div class="absolute inset-0 bg-black/30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <i data-lucide="camera" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black tracking-tight text-on-surface">{{ $user->name }}</h2>
                            <p class="text-tertiary text-sm font-medium">{{ $user->email }}</p>
                        </div>
                    </div>

                    <input x-ref="avatarInput" type="file" name="avatar" accept="image/*"
                           @change="handleFile($event)" class="hidden">

                    <div x-show="previewUrl !== '{{ $user->avatar_url ? Storage::url($user->avatar_url) : '' }}'" style="display:none" class="flex gap-3">
                        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-black rounded-full text-sm hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/20">
                            Simpan Foto
                        </button>
                        <button type="button" @click="previewUrl = '{{ $user->avatar_url ? Storage::url($user->avatar_url) : '' }}'; $refs.avatarInput.value = ''"
                                class="px-6 py-2.5 border border-surface-container-high text-tertiary font-black rounded-full text-sm hover:bg-surface-container-high transition-all">
                            Batal
                        </button>
                    </div>
                </form>
            </section>

            {{-- Form Edit Profil --}}
            <section class="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)]">
                <h2 class="text-xl font-black tracking-tight text-on-surface mb-6">Informasi Akun</h2>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Nama Lengkap</label>
                        <input name="name" type="text" value="{{ old('name', $user->name) }}" required
                               class="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-base font-medium transition-all outline-none">
                        @error('name') <p class="text-red-500 text-xs mt-1 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Email Address</label>
                        <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-base font-medium transition-all outline-none">
                        @error('email') <p class="text-red-500 text-xs mt-1 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Bio <span class="font-normal normal-case tracking-normal">(opsional)</span></label>
                        <textarea name="bio" rows="3"
                                  class="w-full px-6 py-4 bg-surface-container rounded-3xl border-none focus:ring-2 focus:ring-primary/20 text-base font-medium transition-all outline-none resize-none"
                                  placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-10 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>

            {{-- Keamanan / Ganti Password --}}
            <section class="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high">
                <h2 class="text-xl font-black tracking-tight text-on-surface mb-6">Keamanan</h2>
                <a href="{{ route('password.request') }}"
                   class="flex items-center justify-between p-6 bg-surface-container-lowest rounded-2xl hover:shadow-md transition-all group cursor-pointer no-underline">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="font-black text-on-surface">Ubah Password</p>
                            <p class="text-sm text-tertiary font-medium">Kirim link reset ke email Anda</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="text-tertiary group-hover:text-primary transition-colors w-6 h-6"></i>
                </a>
            </section>
        </div>

        {{-- ====== RIGHT COLUMN ====== --}}
        <div class="lg:col-span-5 space-y-8">

            {{-- Sertifikat --}}
            <section class="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)]">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-2xl font-black tracking-tight text-on-surface">Sertifikat Anda</h2>
                    <span class="text-primary font-bold text-sm">{{ $enrollments->count() }} Kursus</span>
                </div>

                @if($enrollments->isEmpty())
                <div class="text-center py-10 border border-dashed border-surface-container-high rounded-2xl">
                    <i data-lucide="award" class="w-12 h-12 text-tertiary mx-auto mb-3 opacity-40"></i>
                    <p class="font-bold text-on-surface">Belum Ada Sertifikat</p>
                    <p class="text-sm text-tertiary mt-1">Selesaikan 100% materi kursus untuk mendapatkan sertifikat.</p>
                </div>
                @else
                <div class="space-y-4">
                    @foreach($enrollments as $enrollment)
                    <div class="group bg-surface-container-low p-4 rounded-2xl flex items-center gap-4 hover:bg-surface-container-high transition-colors">
                        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="font-black text-on-surface leading-tight truncate">{{ $enrollment->course->title }}</p>
                            <p class="text-xs text-tertiary font-medium mt-0.5">Selesai {{ $enrollment->updated_at->format('d M Y') }}</p>
                        </div>
                        <a href="{{ route('course.certificate', $enrollment->course_id) }}"
                           title="Download Sertifikat"
                           class="p-2.5 rounded-full hover:bg-primary/10 text-tertiary hover:text-primary transition-all shrink-0">
                            <i data-lucide="download" class="w-5 h-5"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Stats --}}
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="bg-primary/10 p-6 rounded-2xl text-primary">
                        <p class="text-xs font-black uppercase tracking-widest opacity-70">Kursus Selesai</p>
                        <p class="text-4xl font-black mt-2">{{ $enrollments->count() }}</p>
                    </div>
                    <div class="bg-surface-container-high p-6 rounded-2xl text-on-surface">
                        <p class="text-xs font-black uppercase tracking-widest text-tertiary">Bergabung Sejak</p>
                        <p class="text-lg font-black mt-2">{{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </section>

            {{-- Help Card --}}
            <section class="bg-on-surface text-surface p-8 rounded-[2rem] relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-2xl font-black tracking-tight mb-2">Butuh Bantuan?</h3>
                    <p class="opacity-80 mb-6 text-sm font-medium">Tim support kami siap membantu Anda 24/7.</p>
                    <a href="/support" class="inline-block bg-surface text-on-surface px-8 py-3 rounded-full font-black text-sm hover:scale-105 active:scale-95 transition-all">
                        Hubungi Support
                    </a>
                </div>
                <div class="absolute -right-6 -bottom-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="help-circle" class="w-40 h-40"></i>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
