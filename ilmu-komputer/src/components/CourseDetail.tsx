import React from 'react';
import { 
  Award, 
  Play, 
  Clock, 
  BarChart, 
  Globe, 
  RefreshCw, 
  ChevronDown, 
  ChevronUp, 
  PlayCircle, 
  FileText, 
  Lock, 
  Star, 
  Mail, 
  CheckSquare,
  ArrowRight
} from 'lucide-react';

interface CourseDetailProps {
  onPageChange: (page: string) => void;
}

export default function CourseDetail({ onPageChange }: CourseDetailProps) {
  return (
    <div className="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
      {/* Hero Section */}
      <section className="mb-20 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div className="order-2 lg:order-1">
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 text-primary font-black text-xs mb-8 uppercase tracking-widest">
            <Award size={14} />
            BESTSELLER COURSE
          </div>
          <h1 className="text-5xl lg:text-7xl font-black text-on-surface mb-8 leading-[0.9] tracking-tighter">
            Mastering <span className="text-primary">Python</span> for Beginners
          </h1>
          <p className="text-xl text-tertiary mb-10 leading-relaxed max-w-xl font-medium">
            Finally, a programming course designed for human beings. No complex jargon, just clear, step-by-step guidance to build your first apps.
          </p>
          <div className="flex flex-wrap gap-6 items-center">
            <button 
              onClick={() => onPageChange('dashboard')}
              className="bg-primary text-white px-10 py-5 rounded-full font-black text-lg shadow-2xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all"
            >
              Enroll Now — Rp 499.000
            </button>
            <div className="flex items-center gap-4">
              <div className="flex -space-x-3">
                {[1, 2, 3].map((i) => (
                  <img 
                    key={i}
                    className="w-12 h-12 rounded-full border-4 border-surface" 
                    src={`https://picsum.photos/seed/student${i}/100/100`}
                    alt="Student"
                    referrerPolicy="no-referrer"
                  />
                ))}
              </div>
              <span className="text-sm font-bold text-tertiary uppercase tracking-widest">+12.4k Students</span>
            </div>
          </div>
        </div>
        <div className="order-1 lg:order-2 relative">
          <div className="aspect-video rounded-[2.5rem] overflow-hidden shadow-2xl bg-surface-container-high relative group">
            <img 
              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
              src="https://picsum.photos/seed/python/1200/800"
              alt="Course Preview"
              referrerPolicy="no-referrer"
            />
            <div className="absolute inset-0 bg-on-surface/20 flex items-center justify-center">
              <button 
                onClick={() => onPageChange('lesson')}
                className="w-24 h-24 bg-white text-primary rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform"
              >
                <Play size={40} fill="currentColor" className="ml-2" />
              </button>
            </div>
          </div>
          <div className="absolute -bottom-8 -left-8 bg-surface-container-lowest p-8 rounded-[2rem] shadow-2xl hidden md:block border border-surface-container-high">
            <div className="flex items-center gap-4">
              <div className="bg-primary/10 p-4 rounded-2xl text-primary">
                <Clock size={24} />
              </div>
              <div>
                <p className="text-xs text-tertiary font-black uppercase tracking-widest">Duration</p>
                <p className="text-2xl font-black text-on-surface tracking-tighter">12.5 Hours</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Course Meta Grid */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-32">
        {[
          { icon: <BarChart />, label: 'Difficulty', value: 'Absolute Beginner' },
          { icon: <Globe />, label: 'Language', value: 'Bahasa Indonesia' },
          { icon: <RefreshCw />, label: 'Last Updated', value: 'Jan 2024' },
          { icon: <Award />, label: 'Certificate', value: 'Included' }
        ].map((item, i) => (
          <div key={i} className="bg-surface-container-low p-8 rounded-[2rem] flex flex-col gap-3 border border-surface-container-high">
            <div className="text-primary">{item.icon}</div>
            <span className="text-xs font-black text-tertiary uppercase tracking-widest">{item.label}</span>
            <p className="font-black text-on-surface">{item.value}</p>
          </div>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-20">
        <div className="lg:col-span-2">
          {/* Syllabus */}
          <section className="mb-20">
            <h2 className="text-4xl font-black mb-12 flex items-center gap-4 tracking-tighter">
              <span className="w-2 h-10 bg-primary rounded-full"></span>
              Course Syllabus
            </h2>
            <div className="space-y-6">
              {[
                { id: 1, title: 'Foundations of Python', lessons: 8, open: true },
                { id: 2, title: 'Control Flow & Logic', lessons: 12, open: false },
                { id: 3, title: 'Real-World Projects', lessons: 5, open: false }
              ].map((module) => (
                <div key={module.id} className="bg-surface-container-low rounded-[2rem] border border-surface-container-high overflow-hidden">
                  <button className="w-full p-8 flex justify-between items-center text-left">
                    <div className="flex items-center gap-6">
                      <div className="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center font-black text-primary">{module.id}</div>
                      <span className="text-xl font-black tracking-tight">{module.title}</span>
                    </div>
                    {module.open ? <ChevronUp size={24} /> : <ChevronDown size={24} />}
                  </button>
                  {module.open && (
                    <div className="px-8 pb-8 space-y-4">
                      <div 
                        onClick={() => onPageChange('lesson')}
                        className="flex items-center gap-4 p-4 rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors group"
                      >
                        <PlayCircle size={20} className="text-primary" />
                        <span className="flex-grow font-bold text-tertiary group-hover:text-on-surface">Installing Python & VS Code</span>
                        <span className="text-xs font-black text-tertiary">08:45</span>
                      </div>
                      <div 
                        onClick={() => onPageChange('lesson')}
                        className="flex items-center gap-4 p-4 rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors group"
                      >
                        <PlayCircle size={20} className="text-primary" />
                        <span className="flex-grow font-bold text-tertiary group-hover:text-on-surface">Variables and Data Types</span>
                        <span className="text-xs font-black text-tertiary">15:20</span>
                      </div>
                      <div className="flex items-center gap-4 p-4 rounded-2xl opacity-50">
                        <FileText size={20} className="text-tertiary" />
                        <span className="flex-grow font-bold text-tertiary">Practice Quiz: Foundations</span>
                        <Lock size={16} className="text-tertiary" />
                      </div>
                    </div>
                  )}
                </div>
              ))}
            </div>
          </section>

          {/* Reviews */}
          <section>
            <div className="flex items-center justify-between mb-12">
              <h2 className="text-4xl font-black flex items-center gap-4 tracking-tighter">
                <span className="w-2 h-10 bg-primary rounded-full"></span>
                Student Reviews
              </h2>
              <div className="flex items-center gap-2 text-primary">
                <Star size={24} fill="currentColor" />
                <span className="font-black text-3xl tracking-tighter">4.9</span>
              </div>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {[
                { name: 'Budi Santoso', text: '"As a complete \'gaptek\' person, I was terrified of coding. This course made it feel like playing with LEGO. Sangat membantu!"' },
                { name: 'Siti Aminah', text: '"The instructor\'s explanations are so clear. I managed to automate my repetitive office tasks in just 2 weeks!"' }
              ].map((review, i) => (
                <div key={i} className="bg-surface-container-low p-10 rounded-[2.5rem] border border-surface-container-high flex flex-col gap-6">
                  <div className="flex items-center gap-4">
                    <img className="w-14 h-14 rounded-full" src={`https://picsum.photos/seed/rev${i}/100/100`} alt={review.name} referrerPolicy="no-referrer" />
                    <div>
                      <p className="font-black text-on-surface">{review.name}</p>
                      <div className="flex text-primary">
                        {[1, 2, 3, 4, 5].map((s) => <Star key={s} size={14} fill="currentColor" />)}
                      </div>
                    </div>
                  </div>
                  <p className="text-tertiary leading-relaxed italic font-medium">{review.text}</p>
                </div>
              ))}
            </div>
          </section>
        </div>

        <aside className="space-y-12">
          {/* Instructor */}
          <section className="bg-surface-container-lowest p-10 rounded-[2.5rem] shadow-2xl shadow-primary/5 border border-surface-container-high">
            <h3 className="text-2xl font-black mb-8 tracking-tight">Your Instructor</h3>
            <div className="flex flex-col items-center text-center">
              <img className="w-32 h-32 rounded-full mb-6 ring-4 ring-primary/10" src="https://picsum.photos/seed/raka/200/200" alt="Instructor" referrerPolicy="no-referrer" />
              <h4 className="text-2xl font-black mb-1">Raka Kurnia</h4>
              <p className="text-primary font-black text-xs uppercase tracking-widest mb-6">Senior Developer @ TechCo</p>
              <p className="text-sm text-tertiary leading-relaxed font-medium">
                Raka has taught over 50,000 students globally. He specializes in making complex computer science topics accessible to everyone.
              </p>
              <div className="flex gap-4 mt-8">
                <button className="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 hover:text-primary transition-colors">
                  <Mail size={20} />
                </button>
                <button className="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 hover:text-primary transition-colors">
                  <Globe size={20} />
                </button>
              </div>
            </div>
          </section>

          {/* Prerequisites */}
          <section className="bg-surface-container-low p-10 rounded-[2.5rem] border border-surface-container-high">
            <h3 className="text-2xl font-black mb-8 flex items-center gap-3 tracking-tight">
              <CheckSquare size={24} className="text-primary" />
              Prerequisites
            </h3>
            <ul className="space-y-6">
              {[
                'Basic computer literacy (typing, opening files)',
                'A laptop (Windows, Mac, or Linux)',
                'A stable internet connection for videos',
                'A curious mind and a willingness to try!'
              ].map((item, i) => (
                <li key={i} className="flex gap-4">
                  <div className="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 mt-0.5">
                    <ArrowRight size={14} />
                  </div>
                  <span className="text-tertiary font-bold leading-tight">{item}</span>
                </li>
              ))}
            </ul>
          </section>

          {/* Floating Sticky CTA */}
          <div className="hidden lg:block sticky top-28 p-10 border-2 border-primary/20 rounded-[2.5rem] bg-surface-container-lowest shadow-2xl shadow-primary/5">
            <p className="text-xs font-black text-tertiary mb-2 uppercase tracking-widest">Lifetime Access</p>
            <div className="text-4xl font-black text-on-surface mb-8 tracking-tighter">Rp 499.000</div>
            <button 
              onClick={() => onPageChange('dashboard')}
              className="w-full py-5 bg-primary text-white rounded-full font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all mb-6"
            >
              Enroll Now
            </button>
            <p className="text-xs text-center text-tertiary font-bold uppercase tracking-widest">30-day money back guarantee</p>
          </div>
        </aside>
      </div>
    </div>
  );
}
