import React from 'react';
import { Search, Key, GraduationCap, CreditCard, ArrowRight, Mail, MessageCircle, Send, Globe, Share2 } from 'lucide-react';

interface SupportProps {
  onPageChange: (page: string) => void;
}

export default function Support({ onPageChange }: SupportProps) {
  return (
    <div className="pt-12 pb-20">
      {/* Hero & Help Search */}
      <section className="max-w-7xl mx-auto px-8 py-20 text-center">
        <h1 className="text-6xl md:text-8xl font-black text-on-surface tracking-tighter mb-8 leading-[0.9]">How can we help?</h1>
        <p className="text-2xl text-tertiary mb-16 max-w-2xl mx-auto font-medium">
          Search our knowledge base or browse categories below to find answers to common questions about your learning journey.
        </p>
        <div className="relative max-w-3xl mx-auto group">
          <div className="absolute inset-y-0 left-8 flex items-center pointer-events-none text-tertiary group-focus-within:text-primary transition-colors">
            <Search size={28} />
          </div>
          <input 
            className="w-full pl-20 pr-10 py-8 rounded-full border-none bg-surface-container-lowest shadow-2xl shadow-on-surface/5 focus:ring-4 focus:ring-primary/10 text-xl placeholder:text-stone-400 font-medium" 
            placeholder="Search for questions, topics, or keywords..." 
            type="text"
          />
        </div>
      </section>

      {/* Category Grid */}
      <section className="max-w-7xl mx-auto px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {[
            { 
              icon: <Key size={32} />, 
              title: 'Account Access', 
              desc: 'Login issues, password resets, and managing your personal profile information.',
              color: 'bg-secondary-container/20 text-secondary-container'
            },
            { 
              icon: <GraduationCap size={32} />, 
              title: 'Course Issues', 
              desc: 'Technical difficulties with videos, course materials, or certificate generation.',
              color: 'bg-primary/10 text-primary'
            },
            { 
              icon: <CreditCard size={32} />, 
              title: 'Payments', 
              desc: 'Invoices, refund policies, subscription management, and payment methods.',
              color: 'bg-secondary-fixed/20 text-secondary-fixed-dim'
            }
          ].map((cat, i) => (
            <div key={i} className="group p-10 rounded-[2.5rem] bg-surface-container-low hover:bg-surface-container transition-all duration-500 cursor-pointer border border-surface-container-high">
              <div className={`w-16 h-16 rounded-2xl ${cat.color} flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500`}>
                {cat.icon}
              </div>
              <h3 className="text-2xl font-black mb-4 tracking-tight">{cat.title}</h3>
              <p className="text-tertiary font-medium mb-8 leading-relaxed">{cat.desc}</p>
              <div className="flex items-center text-primary font-black text-xs uppercase tracking-widest gap-2">
                View articles <ArrowRight size={16} />
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* Contact Section */}
      <section className="max-w-7xl mx-auto px-8 py-32 mt-12">
        <div className="bg-surface-container-lowest rounded-[3rem] p-10 md:p-20 flex flex-col lg:row-reverse lg:flex-row gap-20 shadow-2xl shadow-on-surface/5 overflow-hidden relative border border-surface-container-high">
          <div className="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>
          
          <div className="w-full lg:w-1/2 relative z-10">
            <h2 className="text-5xl font-black mb-6 tracking-tighter">We're here to help!</h2>
            <p className="text-xl text-tertiary mb-12 font-medium leading-relaxed">Can't find what you're looking for? Send us a message and our support team will get back to you within 24 hours.</p>
            
            <div className="space-y-10">
              <div className="flex items-center gap-6">
                <div className="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-primary shadow-lg shadow-primary/5">
                  <Mail size={24} />
                </div>
                <div>
                  <p className="text-xs font-black uppercase tracking-widest text-tertiary mb-1">Email Support</p>
                  <p className="text-xl font-black text-on-surface tracking-tight">support@ilmukomputer.com</p>
                </div>
              </div>
              <div className="flex items-center gap-6">
                <div className="w-14 h-14 rounded-2xl bg-surface-container-low flex items-center justify-center text-green-500 shadow-lg shadow-green-500/5">
                  <MessageCircle size={24} />
                </div>
                <div>
                  <p className="text-xs font-black uppercase tracking-widest text-tertiary mb-1">WhatsApp Support</p>
                  <p className="text-xl font-black text-on-surface tracking-tight">+62 812-3456-7890</p>
                </div>
              </div>
            </div>

            <div className="mt-16 rounded-[2rem] overflow-hidden h-64 relative shadow-xl">
              <img 
                className="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000" 
                src="https://picsum.photos/seed/support-team/800/600" 
                alt="Support Team"
                referrerPolicy="no-referrer"
              />
            </div>
          </div>

          <div className="w-full lg:w-1/2 bg-surface-container-low rounded-[2.5rem] p-10 md:p-12 border border-surface-container-high">
            <form className="space-y-8" onSubmit={(e) => e.preventDefault()}>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div className="space-y-3">
                  <label className="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Full Name</label>
                  <input 
                    className="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium" 
                    placeholder="John Doe" 
                    type="text"
                  />
                </div>
                <div className="space-y-3">
                  <label className="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Email Address</label>
                  <input 
                    className="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium" 
                    placeholder="john@example.com" 
                    type="email"
                  />
                </div>
              </div>
              <div className="space-y-3">
                <label className="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Subject</label>
                <select className="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium appearance-none cursor-pointer">
                  <option>Technical Issue</option>
                  <option>Billing Question</option>
                  <option>Content Suggestion</option>
                  <option>Other</option>
                </select>
              </div>
              <div className="space-y-3">
                <label className="text-xs font-black uppercase tracking-widest text-tertiary ml-1">Your Message</label>
                <textarea 
                  className="w-full px-6 py-4 rounded-2xl border-none bg-surface-container-lowest focus:ring-4 focus:ring-primary/10 text-lg font-medium resize-none" 
                  placeholder="How can we help you today?" 
                  rows={5}
                ></textarea>
              </div>
              <button className="w-full py-5 rounded-full bg-primary text-white font-black text-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 shadow-xl shadow-primary/20">
                Send Message
                <Send size={20} />
              </button>
            </form>
          </div>
        </div>
      </section>

      {/* Language & Share */}
      <section className="max-w-7xl mx-auto px-8 py-12 flex justify-center gap-6">
        <button className="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center text-tertiary hover:text-primary transition-colors shadow-lg">
          <Globe size={24} />
        </button>
        <button className="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center text-tertiary hover:text-primary transition-colors shadow-lg">
          <Share2 size={24} />
        </button>
      </section>
    </div>
  );
}
