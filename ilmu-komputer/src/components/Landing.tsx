import React from 'react';
import { motion } from 'motion/react';
import { ArrowRight, BookOpen, Code, Cpu, Globe } from 'lucide-react';

interface LandingProps {
  onPageChange: (page: string) => void;
}

export default function Landing({ onPageChange }: LandingProps) {
  return (
    <div className="flex flex-col">
      {/* Hero Section */}
      <section className="relative h-[80vh] flex items-center overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img 
            src="https://picsum.photos/seed/tech/1920/1080" 
            alt="Hero Background" 
            className="w-full h-full object-cover opacity-20"
            referrerPolicy="no-referrer"
          />
          <div className="absolute inset-0 bg-gradient-to-b from-surface/0 via-surface/50 to-surface"></div>
        </div>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
            className="max-w-3xl"
          >
            <span className="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest mb-6">
              Premium Learning Experience
            </span>
            <h1 className="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] text-on-surface mb-8">
              Master the <span className="text-primary">Architecture</span> of Tomorrow.
            </h1>
            <p className="text-xl text-tertiary leading-relaxed mb-10 max-w-xl">
              Deep dive into computer science with our editorial-grade courses. From low-level systems to high-level AI architectures.
            </p>
            <div className="flex flex-wrap gap-4">
              <button 
                onClick={() => onPageChange('catalog')}
                className="px-8 py-4 rounded-full bg-primary text-white font-black text-lg shadow-2xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all flex items-center gap-2"
              >
                Explore Courses <ArrowRight size={20} />
              </button>
              <button 
                onClick={() => onPageChange('pathway')}
                className="px-8 py-4 rounded-full bg-surface-container-high text-on-surface font-black text-lg hover:bg-surface-container-highest transition-all"
              >
                View Curriculum
              </button>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-20 border-y border-surface-container-high">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-12">
            {[
              { label: 'Courses', value: '120+' },
              { label: 'Students', value: '50k+' },
              { label: 'Instructors', value: '45' },
              { label: 'Rating', value: '4.9/5' }
            ].map((stat, i) => (
              <div key={i} className="flex flex-col items-center md:items-start">
                <span className="text-4xl font-black text-primary tracking-tighter">{stat.value}</span>
                <span className="text-sm font-bold text-tertiary uppercase tracking-widest">{stat.label}</span>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-32">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-20">
            <h2 className="text-4xl md:text-5xl font-black tracking-tighter text-on-surface mb-4">Why Ilmu Komputer?</h2>
            <p className="text-lg text-tertiary max-w-2xl mx-auto">We don't just teach code. We teach the fundamental principles that define the digital age.</p>
          </div>

          <div className="grid md:grid-cols-3 gap-8">
            {[
              { icon: <Cpu />, title: 'Systems Design', desc: 'Understand how hardware and software interact at the deepest levels.' },
              { icon: <Code />, title: 'Modern Stack', desc: 'Master the tools used by world-class engineering teams today.' },
              { icon: <Globe />, title: 'Global Network', desc: 'Connect with a community of ambitious developers worldwide.' }
            ].map((feature, i) => (
              <div key={i} className="p-8 rounded-3xl bg-surface-container-low border border-surface-container-high hover:border-primary/30 transition-all group">
                <div className="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  {feature.icon}
                </div>
                <h3 className="text-2xl font-black tracking-tight text-on-surface mb-3">{feature.title}</h3>
                <p className="text-tertiary leading-relaxed">{feature.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-32 bg-primary text-white overflow-hidden relative">
        <div className="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
           <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
             <path d="M0 100 L100 0 L100 100 Z" fill="currentColor" />
           </svg>
        </div>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="max-w-3xl">
            <h2 className="text-5xl md:text-7xl font-black tracking-tighter leading-none mb-8">Ready to start your journey?</h2>
            <p className="text-xl text-white/80 mb-10 leading-relaxed">Join thousands of students mastering computer science with our premium curriculum.</p>
            <button 
              onClick={() => onPageChange('register')}
              className="px-10 py-5 rounded-full bg-white text-primary font-black text-xl shadow-2xl hover:scale-105 active:scale-95 transition-all"
            >
              Join Now
            </button>
          </div>
        </div>
      </section>
    </div>
  );
}
