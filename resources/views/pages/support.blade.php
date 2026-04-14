@extends('layouts.app')

@section('content')
<div class="pt-12 pb-20">
    <!-- Hero & Help Search -->
    <section class="max-w-7xl mx-auto px-8 py-20 text-center">
        <h1 class="text-6xl md:text-8xl font-black text-on-surface tracking-tighter mb-8 leading-[0.9]">How can we help?</h1>
        <p class="text-2xl text-tertiary mb-16 max-w-2xl mx-auto font-medium">
            Search our knowledge base or browse categories below to find answers to common questions about your learning journey.
        </p>
        <div class="relative max-w-3xl mx-auto group">
            <div class="absolute inset-y-0 left-8 flex items-center pointer-events-none text-tertiary group-focus-within:text-primary transition-colors">
                <i data-lucide="search" class="w-7 h-7"></i>
            </div>
            <input 
                class="w-full pl-20 pr-10 py-8 rounded-full border-none bg-surface-container-lowest shadow-2xl shadow-on-surface/5 focus:ring-4 focus:ring-primary/10 text-xl placeholder:text-stone-400 font-medium" 
                placeholder="Search for questions, topics, or keywords..." 
                type="text"
            />
        </div>
    </section>

    <!-- Category Grid -->
    <section class="max-w-7xl mx-auto px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $categories = [
                ['icon' => 'key', 'title' => 'Account Access', 'desc' => 'Login issues, password resets, and managing your personal profile information.', 'color' => 'bg-secondary/20 text-secondary'],
                ['icon' => 'graduation-cap', 'title' => 'Course Issues', 'desc' => 'Technical difficulties with videos, course materials, or certificate generation.', 'color' => 'bg-primary/10 text-primary'],
                ['icon' => 'credit-card', 'title' => 'Payments', 'desc' => 'Invoices, refund policies, subscription management, and payment methods.', 'color' => 'bg-tertiary/20 text-tertiary']
            ];
            @endphp
            @foreach($categories as $cat)
            <div class="group p-10 rounded-[2.5rem] bg-surface-container-low hover:bg-surface-container transition-all duration-500 cursor-pointer border border-surface-container-high">
                <div class="w-16 h-16 rounded-2xl {{ $cat['color'] }} flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="{{ $cat['icon'] }}" class="w-8 h-8"></i>
                </div>
                <h3 class="text-2xl font-black mb-4 tracking-tight">{{ $cat['title'] }}</h3>
                <p class="text-tertiary font-medium mb-8 leading-relaxed">{{ $cat['desc'] }}</p>
                <div class="flex items-center text-primary font-black text-xs uppercase tracking-widest gap-2">
                    View articles <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Contact Section -->
    <section class="max-w-7xl mx-auto px-8 py-32 mt-12">
        <div class="bg-surface-container-lowest rounded-[3rem] p-10 md:p-20 flex flex-col lg:row-reverse lg:flex-row gap-20 shadow-2xl shadow-on-surface/5 overflow-hidden relative border border-surface-container-high">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>
            
            <div class="w-full lg:w-1/2 relative z-10">
                <h2 class="text-5xl font-black mb-6 tracking-tighter">We're here to help!</h2>
                <p class="text-xl text-tertiary mb-12 font-medium leading-relaxed">Can't find what you're looking for? Send us a message and our support team will get back to you within 24 hours.</p>
                
                <div class="space-y-10">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-primary shadow-lg shadow-primary/5">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-tertiary mb-1">Email Support</p>
                            <p class="text-xl font-black text-on-surface tracking-tight">support@ilmukomputer.com</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-green-500 shadow-lg shadow-green-500/5">
                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-tertiary mb-1">WhatsApp Support</p>
                            <p class="text-xl font-black text-on-surface tracking-tight">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 rounded-[2rem] overflow-hidden h-64 relative shadow-xl">
                    <img 
                        class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000" 
                        src="https://picsum.photos/seed/support-team/800/600" 
                        alt="Support Team"
                        referrerpolicy="no-referrer"
                    />
                </div>
            </div>

            <div class="w-full lg:w-1/2 bg-surface-container-low rounded-[2.5rem] p-10 md:p-12 border border-surface-container-high">
                <form class="space-y-8" method="POST" action="#">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Full Name</label>
                            <input 
                                class="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium" 
                                placeholder="John Doe" 
                                type="text"
                                name="name"
                            />
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Email Address</label>
                            <input 
                                class="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium" 
                                placeholder="john@example.com" 
                                type="email"
                                name="email"
                            />
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Subject</label>
                        <select name="subject" class="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium appearance-none cursor-pointer">
                            <option>Technical Issue</option>
                            <option>Billing Question</option>
                            <option>Content Suggestion</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Your Message</label>
                        <textarea 
                            name="message"
                            class="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium resize-none" 
                            placeholder="How can we help you today?" 
                            rows="5"
                        ></textarea>
                    </div>
                    <button type="submit" class="w-full py-5 rounded-full bg-primary text-white font-black text-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 shadow-xl shadow-primary/20">
                        Send Message
                        <i data-lucide="send" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Language & Share -->
    <section class="max-w-7xl mx-auto px-8 py-12 flex justify-center gap-6">
        <button class="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center text-tertiary hover:text-primary transition-colors shadow-lg">
            <i data-lucide="globe" class="w-6 h-6"></i>
        </button>
        <button class="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center text-tertiary hover:text-primary transition-colors shadow-lg">
            <i data-lucide="share-2" class="w-6 h-6"></i>
        </button>
    </section>
</div>
@endsection
