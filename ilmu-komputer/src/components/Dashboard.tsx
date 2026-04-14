import React from 'react';
import { Play, CheckCircle, Clock, Award, ChevronRight } from 'lucide-react';

const myCourses = [
  {
    id: 1,
    title: 'Advanced Data Structures',
    progress: 65,
    lastAccessed: '2 hours ago',
    image: 'https://picsum.photos/seed/data/400/300'
  },
  {
    id: 2,
    title: 'Modern Web Performance',
    progress: 30,
    lastAccessed: 'Yesterday',
    image: 'https://picsum.photos/seed/web/400/300'
  }
];

interface DashboardProps {
  onPageChange: (page: string) => void;
}

export default function Dashboard({ onPageChange }: DashboardProps) {
  return (
    <div className="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
      <div className="mb-12">
        <h1 className="text-5xl font-black tracking-tighter text-on-surface mb-2">Welcome back, Alex</h1>
        <p className="text-lg text-tertiary">
          You've completed 40% of your current{' '}
          <button onClick={() => onPageChange('pathway')} className="text-primary font-bold hover:underline">learning path</button>.
        </p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {/* Main Content */}
        <div className="lg:col-span-2 space-y-8">
          <section>
            <h2 className="text-2xl font-black tracking-tight text-on-surface mb-6 flex items-center gap-2">
              Continue Learning <ChevronRight size={20} className="text-primary" />
            </h2>
            <div className="grid gap-6">
              {myCourses.map((course) => (
                <div key={course.id} className="flex flex-col sm:flex-row bg-surface-container-low rounded-3xl border border-surface-container-high overflow-hidden hover:border-primary/30 transition-all group">
                  <div className="w-full sm:w-48 aspect-video sm:aspect-square overflow-hidden">
                    <img 
                      src={course.image} 
                      alt={course.title} 
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                      referrerPolicy="no-referrer"
                    />
                  </div>
                  <div className="p-6 flex-grow flex flex-col justify-center">
                    <div className="flex justify-between items-start mb-2">
                      <h3 className="text-xl font-black tracking-tight text-on-surface">{course.title}</h3>
                      <span className="text-xs font-bold text-tertiary uppercase tracking-widest">{course.lastAccessed}</span>
                    </div>
                    <div className="mb-6">
                      <div className="flex justify-between text-sm font-bold text-tertiary mb-2">
                        <span>Progress</span>
                        <span>{course.progress}%</span>
                      </div>
                      <div className="h-2 bg-surface-container-high rounded-full overflow-hidden">
                        <div 
                          className="h-full bg-primary transition-all duration-1000" 
                          style={{ width: `${course.progress}%` }}
                        ></div>
                      </div>
                    </div>
                    <button 
                      onClick={() => onPageChange('lesson')}
                      className="self-start px-6 py-2 rounded-full bg-primary text-white font-bold text-sm flex items-center gap-2 hover:scale-105 active:scale-95 transition-all"
                    >
                      <Play size={16} fill="currentColor" /> Resume
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </section>

          <section>
            <h2 className="text-2xl font-black tracking-tight text-on-surface mb-6">Recommended for You</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
              {[1, 2].map((i) => (
                <div key={i} className="p-6 rounded-3xl bg-surface-container-low border border-surface-container-high hover:tonal-lift transition-all">
                  <div className="w-full aspect-video rounded-2xl bg-surface-container-high mb-4 overflow-hidden">
                    <img 
                      src={`https://picsum.photos/seed/rec${i}/600/400`} 
                      alt="Recommended" 
                      className="w-full h-full object-cover"
                      referrerPolicy="no-referrer"
                    />
                  </div>
                  <h3 className="text-lg font-black tracking-tight text-on-surface mb-2">System Design Interview Guide</h3>
                  <p className="text-sm text-tertiary mb-4">Master the art of scaling applications for millions of users.</p>
                  <button 
                    onClick={() => onPageChange('course-detail')}
                    className="text-primary font-bold text-sm hover:underline"
                  >
                    View Details
                  </button>
                </div>
              ))}
            </div>
          </section>
        </div>

        {/* Sidebar */}
        <div className="space-y-8">
          <div className="p-8 rounded-[2.5rem] bg-primary text-white shadow-2xl shadow-primary/20">
            <h3 className="text-2xl font-black tracking-tight mb-4">Your Achievements</h3>
            <div className="space-y-6">
              {[
                { icon: <Award />, title: 'Fast Learner', desc: 'Completed 5 lessons in a day' },
                { icon: <CheckCircle />, title: 'Perfect Score', desc: '100% on Data Structures quiz' },
                { icon: <Clock />, title: 'Consistent', desc: '7 day learning streak' }
              ].map((ach, i) => (
                <div key={i} className="flex items-center gap-4">
                  <div className="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                    {ach.icon}
                  </div>
                  <div>
                    <h4 className="font-bold leading-none mb-1">{ach.title}</h4>
                    <p className="text-xs text-white/70">{ach.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div className="p-8 rounded-[2.5rem] bg-surface-container-low border border-surface-container-high">
            <h3 className="text-xl font-black tracking-tight text-on-surface mb-6">Upcoming Events</h3>
            <div className="space-y-6">
              {[1, 2].map((i) => (
                <div key={i} className="flex gap-4">
                  <div className="flex-shrink-0 w-12 h-12 rounded-2xl bg-surface-container-high flex flex-col items-center justify-center">
                    <span className="text-xs font-black text-primary leading-none">OCT</span>
                    <span className="text-lg font-black text-on-surface leading-none">1{i}</span>
                  </div>
                  <div>
                    <h4 className="font-bold text-on-surface leading-tight mb-1">Live Q&A: Distributed Systems</h4>
                    <p className="text-xs text-tertiary">4:00 PM - 5:30 PM</p>
                  </div>
                </div>
              ))}
            </div>
            <button className="w-full mt-8 py-3 rounded-2xl border border-surface-container-high text-sm font-bold text-on-surface hover:bg-surface-container-high transition-all">
              View All Events
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
