import React from 'react';
import { Search, Filter, Star, Clock, BookOpen } from 'lucide-react';

const courses = [
  {
    id: 1,
    title: 'Advanced Data Structures',
    category: 'Computer Science',
    level: 'Advanced',
    duration: '12 Weeks',
    rating: 4.9,
    image: 'https://picsum.photos/seed/data/800/600',
    price: '$199'
  },
  {
    id: 2,
    title: 'Distributed Systems Architecture',
    category: 'Systems',
    level: 'Expert',
    duration: '16 Weeks',
    rating: 4.8,
    image: 'https://picsum.photos/seed/systems/800/600',
    price: '$249'
  },
  {
    id: 3,
    title: 'Modern Web Performance',
    category: 'Web Dev',
    level: 'Intermediate',
    duration: '8 Weeks',
    rating: 4.7,
    image: 'https://picsum.photos/seed/web/800/600',
    price: '$149'
  },
  {
    id: 4,
    title: 'Machine Learning Foundations',
    category: 'AI/ML',
    level: 'Beginner',
    duration: '10 Weeks',
    rating: 4.9,
    image: 'https://picsum.photos/seed/ai/800/600',
    price: '$179'
  },
  {
    id: 5,
    title: 'Cybersecurity Fundamentals',
    category: 'Security',
    level: 'Intermediate',
    duration: '12 Weeks',
    rating: 4.6,
    image: 'https://picsum.photos/seed/security/800/600',
    price: '$189'
  },
  {
    id: 6,
    title: 'Cloud Native Engineering',
    category: 'Cloud',
    level: 'Advanced',
    duration: '14 Weeks',
    rating: 4.8,
    image: 'https://picsum.photos/seed/cloud/800/600',
    price: '$219'
  }
];

interface CatalogProps {
  onPageChange: (page: string) => void;
}

export default function Catalog({ onPageChange }: CatalogProps) {
  return (
    <div className="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
      <div className="flex flex-col md:flex-row justify-between items-end gap-8 mb-12">
        <div className="max-w-xl">
          <h1 className="text-5xl font-black tracking-tighter text-on-surface mb-4">Course Catalog</h1>
          <p className="text-lg text-tertiary">Explore our curated collection of high-impact computer science courses.</p>
        </div>
        <div className="flex gap-4 w-full md:w-auto">
          <div className="relative flex-grow md:w-80">
            <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary" size={20} />
            <input 
              type="text" 
              placeholder="Search courses..." 
              className="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-low border border-surface-container-high focus:border-primary outline-none transition-all font-medium"
            />
          </div>
          <button className="p-3 rounded-2xl bg-surface-container-low border border-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all">
            <Filter size={24} />
          </button>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {courses.map((course) => (
          <div 
            key={course.id} 
            onClick={() => onPageChange('course-detail')}
            className="group flex flex-col bg-surface-container-low rounded-[2rem] border border-surface-container-high overflow-hidden hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 cursor-pointer"
          >
            <div className="relative aspect-[4/3] overflow-hidden">
              <img 
                src={course.image} 
                alt={course.title} 
                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                referrerPolicy="no-referrer"
              />
              <div className="absolute top-4 left-4">
                <span className="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-primary text-xs font-black uppercase tracking-widest shadow-sm">
                  {course.category}
                </span>
              </div>
            </div>
            <div className="p-8 flex flex-col flex-grow">
              <div className="flex items-center gap-2 mb-3">
                <div className="flex items-center text-yellow-500">
                  <Star size={16} fill="currentColor" />
                  <span className="ml-1 text-sm font-black text-on-surface">{course.rating}</span>
                </div>
                <span className="text-tertiary text-xs">•</span>
                <span className="text-tertiary text-xs font-bold uppercase tracking-widest">{course.level}</span>
              </div>
              <h3 className="text-2xl font-black tracking-tight text-on-surface mb-4 group-hover:text-primary transition-colors leading-tight">
                {course.title}
              </h3>
              <div className="mt-auto pt-6 border-t border-surface-container-high flex items-center justify-between">
                <div className="flex items-center gap-4 text-tertiary">
                  <div className="flex items-center gap-1.5">
                    <Clock size={16} />
                    <span className="text-sm font-bold">{course.duration}</span>
                  </div>
                </div>
                <span className="text-2xl font-black text-primary">{course.price}</span>
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="mt-20 text-center">
        <button className="px-10 py-4 rounded-full border-2 border-surface-container-high text-on-surface font-black hover:bg-surface-container-low transition-all">
          Load More Courses
        </button>
      </div>
    </div>
  );
}
