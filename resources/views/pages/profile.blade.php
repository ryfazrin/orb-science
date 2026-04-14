@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Profile Hero Section -->
    <header class="mb-12">
        <h1 class="text-5xl font-black tracking-tighter text-on-surface mb-2">Your Profile</h1>
        <p class="text-lg text-tertiary">Manage your account settings and view your achievements.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Profile Settings Form -->
        <div class="lg:col-span-7 space-y-8">
            <section class="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)] transition-all">
                <div class="flex items-center gap-6 mb-10">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden ring-4 ring-primary/10">
                            <img 
                                alt="User profile" 
                                class="w-full h-full object-cover" 
                                src="https://picsum.photos/seed/user/200/200"
                                referrerpolicy="no-referrer"
                            />
                        </div>
                        <button class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform active:scale-90">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-on-surface">Change Photo</h2>
                        <p class="text-tertiary text-sm font-medium">JPG or PNG. Max size of 800K</p>
                    </div>
                </div>

                <form class="space-y-6" method="POST" action="#">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Full Name</label>
                        <input 
                            class="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                            placeholder="Enter your full name" 
                            type="text" 
                            value="Aditi Sharma"
                        />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Email Address</label>
                        <input 
                            class="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                            placeholder="Enter your email" 
                            type="email" 
                            value="aditi.sharma@example.com"
                        />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Bio</label>
                        <textarea 
                            class="w-full px-6 py-4 bg-surface-container rounded-3xl border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                            placeholder="Tell us a bit about yourself..." 
                            rows="3"
                        >Aspiring Computer Scientist and lifelong learner. Passionate about AI and community building.</textarea>
                    </div>
                    <div class="pt-4">
                        <button class="w-full md:w-auto px-10 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all" type="submit">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>

            <section class="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high">
                <h2 class="text-xl font-black tracking-tight text-on-surface mb-6">Security</h2>
                <div class="flex items-center justify-between p-6 bg-surface-container-lowest rounded-2xl hover:shadow-md transition-all cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="font-black text-on-surface">Password</p>
                            <p class="text-sm text-tertiary font-medium">Last changed 3 months ago</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="text-tertiary group-hover:text-primary transition-colors w-6 h-6"></i>
                </div>
            </section>
        </div>

        <!-- Right Column: Certificates & Stats -->
        <div class="lg:col-span-5 space-y-8">
            <section class="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)]">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-2xl font-black tracking-tight text-on-surface">Your Certificates</h2>
                    <span class="text-primary font-bold text-sm cursor-pointer hover:underline">View All</span>
                </div>
                <div class="space-y-4">
                    <!-- Certificate Card 1 -->
                    <div class="group bg-surface-container-low p-4 rounded-2xl flex items-center gap-4 hover:bg-surface-container-high transition-colors">
                        <div class="w-16 h-16 rounded-xl bg-white overflow-hidden flex-shrink-0 shadow-sm flex items-center justify-center">
                            <div class="w-full h-full bg-secondary/10 flex items-center justify-center text-secondary">
                                <i data-lucide="award" class="w-8 h-8"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <p class="font-black text-on-surface leading-tight">Data Structures Masterclass</p>
                            <p class="text-sm text-tertiary font-medium">Issued July 2026</p>
                        </div>
                        <button class="p-2 rounded-full hover:bg-white text-tertiary hover:text-primary transition-all">
                            <i data-lucide="download" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <!-- Certificate Card 2 -->
                    <div class="group bg-surface-container-low p-4 rounded-2xl flex items-center gap-4 hover:bg-surface-container-high transition-colors">
                        <div class="w-16 h-16 rounded-xl bg-white overflow-hidden flex-shrink-0 shadow-sm flex items-center justify-center">
                            <div class="w-full h-full bg-primary/10 flex items-center justify-center text-primary">
                                <i data-lucide="graduation-cap" class="w-8 h-8"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <p class="font-black text-on-surface leading-tight">Foundations of CS</p>
                            <p class="text-sm text-tertiary font-medium">Issued May 2026</p>
                        </div>
                        <button class="p-2 rounded-full hover:bg-white text-tertiary hover:text-primary transition-all">
                            <i data-lucide="download" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Learning Stats Bento -->
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="bg-secondary/10 p-6 rounded-2xl text-secondary">
                        <p class="text-xs font-black uppercase tracking-widest opacity-70">Courses Done</p>
                        <p class="text-4xl font-black mt-2">12</p>
                    </div>
                    <div class="bg-primary/10 p-6 rounded-2xl text-primary">
                        <p class="text-xs font-black uppercase tracking-widest opacity-70">Hours Spent</p>
                        <p class="text-4xl font-black mt-2">148</p>
                    </div>
                </div>
            </section>

            <!-- Help Card -->
            <section class="bg-on-surface text-surface p-8 rounded-[2rem] relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-2xl font-black tracking-tight mb-2">Need Help?</h3>
                    <p class="opacity-80 mb-6 text-sm font-medium">Our support team is here to help you 24/7 with any platform issues.</p>
                    <button class="bg-surface text-on-surface px-8 py-3 rounded-full font-black text-sm hover:scale-105 active:scale-95 transition-all">
                        Contact Support
                    </button>
                </div>
                <div class="absolute -right-6 -bottom-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="help-circle" class="w-40 h-40"></i>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
