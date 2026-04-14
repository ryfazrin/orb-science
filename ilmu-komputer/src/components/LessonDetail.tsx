import React, { useState } from 'react';
import { 
  ChevronRight, 
  Play, 
  CheckCircle, 
  XCircle, 
  ArrowLeft, 
  ArrowRight, 
  Search, 
  Bell, 
  User as UserIcon,
  ChevronDown,
  ChevronUp,
  Network,
  GitBranch,
  Database
} from 'lucide-react';

interface LessonDetailProps {
  onPageChange: (page: string) => void;
}

export default function LessonDetail({ onPageChange }: LessonDetailProps) {
  const [isSidebarOpen, setIsSidebarOpen] = useState(true);
  const [activeSection, setActiveSection] = useState('data-structures');

  return (
    <div className="flex min-h-[calc(100vh-5rem)] bg-surface relative">
      {/* Main Content Area */}
      <div className={`flex-1 transition-all duration-300 ${isSidebarOpen ? 'xl:mr-96' : ''}`}>
        <div className="px-6 lg:px-20 py-12 max-w-5xl mx-auto">
          {/* Breadcrumbs */}
          <nav className="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-tertiary mb-8">
            <span onClick={() => onPageChange('catalog')} className="hover:text-primary cursor-pointer">Courses</span>
            <ChevronRight size={10} />
            <span onClick={() => onPageChange('course-detail')} className="hover:text-primary cursor-pointer">Data Structures</span>
            <ChevronRight size={10} />
            <span className="text-primary">Introduction to Linked Lists</span>
          </nav>

          <article className="space-y-12">
            <div className="space-y-6">
              <h1 className="text-5xl md:text-6xl font-black tracking-tighter text-on-surface leading-[0.9]">
                Understanding <span className="text-primary">Singly Linked Lists</span>
              </h1>
              <p className="text-xl text-tertiary leading-relaxed max-w-3xl font-medium">
                A singly linked list is a linear data structure where each element is a separate object, called a node. Each node contains data and a reference to the next node in the sequence.
              </p>
            </div>

            {/* Video Player Placeholder */}
            <div className="relative group aspect-video rounded-[2.5rem] overflow-hidden bg-on-surface shadow-2xl">
              <img 
                alt="Video Placeholder" 
                className="w-full h-full object-cover opacity-40 group-hover:scale-105 transition-transform duration-700" 
                src="https://picsum.photos/seed/linkedlist/1200/800"
                referrerPolicy="no-referrer"
              />
              <div className="absolute inset-0 flex items-center justify-center">
                <button className="w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-2xl shadow-primary/40 group/btn">
                  <Play size={40} fill="currentColor" className="ml-2" />
                </button>
              </div>
              <div className="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 to-transparent">
                <p className="text-white text-xl font-black tracking-tight">Lecture 4.2: Traversing the Chain</p>
                <p className="text-white/60 text-sm font-bold uppercase tracking-widest mt-1">12:45 minutes</p>
              </div>
            </div>

            {/* Reading Section */}
            <div className="prose prose-lg max-w-none text-on-surface/90 leading-relaxed space-y-8">
              <h2 className="text-3xl font-black tracking-tight text-on-surface">The Anatomy of a Node</h2>
              <p className="text-lg">
                In a singly linked list, each node is composed of two items: the <strong className="text-primary">data</strong> and a <strong className="text-primary">next</strong> pointer. This differs from arrays, which occupy a contiguous block of memory. Nodes in a linked list can be scattered throughout memory, connected only by their pointers.
              </p>

              {/* Pros & Cons Grid */}
              <div className="grid grid-cols-1 md:grid-cols-2 gap-8 my-12">
                <div className="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high">
                  <h3 className="text-xl font-black tracking-tight mb-6 text-primary uppercase tracking-widest">Pros</h3>
                  <ul className="space-y-4">
                    <li className="flex items-start gap-3">
                      <CheckCircle size={20} className="text-green-600 mt-1 flex-shrink-0" />
                      <span className="font-medium">Dynamic size: Grows or shrinks as needed during execution.</span>
                    </li>
                    <li className="flex items-start gap-3">
                      <CheckCircle size={20} className="text-green-600 mt-1 flex-shrink-0" />
                      <span className="font-medium">Ease of Insertion/Deletion: No shifting elements required.</span>
                    </li>
                  </ul>
                </div>
                <div className="bg-surface-container-high p-8 rounded-[2rem]">
                  <h3 className="text-xl font-black tracking-tight mb-6 text-on-surface uppercase tracking-widest">Cons</h3>
                  <ul className="space-y-4">
                    <li className="flex items-start gap-3">
                      <XCircle size={20} className="text-red-500 mt-1 flex-shrink-0" />
                      <span className="font-medium">Random access is not allowed: Must traverse from head.</span>
                    </li>
                    <li className="flex items-start gap-3">
                      <XCircle size={20} className="text-red-500 mt-1 flex-shrink-0" />
                      <span className="font-medium">Extra memory space: For pointer storage in each node.</span>
                    </li>
                  </ul>
                </div>
              </div>

              <p className="text-lg">
                Linked lists are particularly useful when you don't know the number of elements in advance or when you need to perform frequent insertions and deletions. However, they come with the trade-off of slower access times for specific elements compared to arrays.
              </p>

              <div className="rounded-[2.5rem] overflow-hidden my-12 shadow-xl bg-surface-container-lowest p-8 border border-surface-container-high">
                <img 
                  className="w-full h-auto rounded-2xl mb-6" 
                  src="https://picsum.photos/seed/code/1200/600"
                  alt="Code Visualization"
                  referrerPolicy="no-referrer"
                />
                <p className="text-center text-sm text-tertiary font-bold italic">Visualizing memory allocation in dynamic structures.</p>
              </div>
            </div>
          </article>
        </div>
      </div>

      {/* Sidebar - Course Content */}
      <aside className={`hidden xl:flex h-[calc(100vh-5rem)] w-96 fixed right-0 top-20 bg-surface-container-low border-l border-surface-container-high flex-col p-8 gap-y-8 overflow-y-auto transition-transform duration-300 ${isSidebarOpen ? 'translate-x-0' : 'translate-x-full'}`}>
        <div className="space-y-4">
          <h2 className="text-2xl font-black tracking-tighter text-on-surface">Course Content</h2>
          <div className="space-y-2">
            <div className="flex items-center justify-between text-sm font-black uppercase tracking-widest">
              <span className="text-tertiary">65% Completed</span>
              <span className="text-primary">12 / 18 Lessons</span>
            </div>
            <div className="w-full bg-surface-container-high h-2 rounded-full overflow-hidden">
              <div className="bg-primary h-full transition-all duration-1000" style={{ width: '65%' }}></div>
            </div>
          </div>
        </div>

        <div className="space-y-4 flex-grow">
          {/* Section 1 */}
          <div className="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-surface-container-high">
            <button 
              onClick={() => setActiveSection(activeSection === 'data-structures' ? '' : 'data-structures')}
              className="flex items-center justify-between w-full text-primary font-black tracking-tight"
            >
              <span className="flex items-center gap-3">
                <Network size={18} />
                Data Structures
              </span>
              {activeSection === 'data-structures' ? <ChevronUp size={20} /> : <ChevronDown size={20} />}
            </button>
            {activeSection === 'data-structures' && (
              <div className="mt-6 space-y-4">
                <a href="#" className="flex items-center gap-3 text-sm font-bold text-tertiary hover:text-on-surface transition-colors group">
                  <CheckCircle size={16} className="text-green-500" fill="currentColor" />
                  <span>Array Basics</span>
                </a>
                <a href="#" className="flex items-center gap-3 text-sm font-black text-primary transition-colors group">
                  <div className="w-4 h-4 rounded-full border-2 border-primary flex items-center justify-center">
                    <div className="w-1.5 h-1.5 rounded-full bg-primary"></div>
                  </div>
                  <span>Linked Lists Intro</span>
                </a>
                <a href="#" className="flex items-center gap-3 text-sm font-bold text-tertiary hover:text-primary transition-colors group">
                  <div className="w-4 h-4 rounded-full border-2 border-surface-container-high"></div>
                  <span>Doubly Linked Lists</span>
                </a>
              </div>
            )}
          </div>

          {/* Section 2 */}
          <div className="bg-surface-container-high/30 rounded-3xl p-6 border border-transparent hover:border-surface-container-high transition-all">
            <button className="flex items-center justify-between w-full text-on-surface font-black tracking-tight opacity-60">
              <span className="flex items-center gap-3">
                <GitBranch size={18} />
                Algorithms
              </span>
              <ChevronDown size={20} />
            </button>
          </div>

          {/* Section 3 */}
          <div className="bg-surface-container-high/30 rounded-3xl p-6 border border-transparent hover:border-surface-container-high transition-all">
            <button className="flex items-center justify-between w-full text-on-surface font-black tracking-tight opacity-60">
              <span className="flex items-center gap-3">
                <Database size={18} />
                Databases
              </span>
              <ChevronDown size={20} />
            </button>
          </div>
        </div>

        <button className="w-full py-4 rounded-2xl bg-on-surface text-surface font-black tracking-tight hover:bg-on-surface/90 transition-all shadow-xl">
          View Certificate
        </button>
      </aside>

      {/* Bottom Navigation Bar */}
      <footer className="fixed bottom-0 left-0 w-full h-24 z-50 bg-surface/90 backdrop-blur-xl border-t border-surface-container-high flex justify-between items-center px-8 lg:px-12 py-4 shadow-[0_-4px_24px_rgba(0,0,0,0.04)]">
        <button 
          onClick={() => onPageChange('dashboard')}
          className="flex items-center gap-2 px-6 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs hover:bg-surface-container-low transition-all active:scale-95"
        >
          <ArrowLeft size={16} />
          Back
        </button>
        
        <div className="flex gap-4">
          <button className="flex items-center gap-2 px-8 py-3 rounded-full bg-primary text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
            <CheckCircle size={16} />
            Mark as Complete
          </button>
          <button className="flex items-center gap-2 px-8 py-3 rounded-full border border-surface-container-high text-tertiary font-black uppercase tracking-widest text-xs opacity-50 cursor-not-allowed">
            Next
            <ArrowRight size={16} />
          </button>
        </div>
      </footer>
    </div>
  );
}
