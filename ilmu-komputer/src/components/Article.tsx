import React from 'react';
import { Calendar, Clock, User, Share2, Bookmark } from 'lucide-react';

export default function Article() {
  return (
    <div className="py-20 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
      <div className="mb-12">
        <div className="flex items-center gap-3 mb-6">
          <span className="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest">Engineering</span>
          <span className="text-tertiary text-xs font-bold uppercase tracking-widest flex items-center gap-1">
            <Clock size={14} /> 12 min read
          </span>
        </div>
        <h1 className="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] text-on-surface mb-8">
          The Evolution of <span className="text-primary">Garbage Collection</span> in Modern Runtimes.
        </h1>
        <div className="flex items-center justify-between py-8 border-y border-surface-container-high">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-full bg-surface-container-high overflow-hidden">
              <img src="https://picsum.photos/seed/author/100/100" alt="Author" referrerPolicy="no-referrer" />
            </div>
            <div>
              <h4 className="font-black text-on-surface leading-none mb-1">Dr. Sarah Chen</h4>
              <p className="text-xs text-tertiary font-bold uppercase tracking-widest">Senior Systems Engineer</p>
            </div>
          </div>
          <div className="flex gap-4">
            <button className="p-2 text-tertiary hover:text-primary transition-colors"><Share2 size={20} /></button>
            <button className="p-2 text-tertiary hover:text-primary transition-colors"><Bookmark size={20} /></button>
          </div>
        </div>
      </div>

      <div className="prose prose-lg max-w-none text-on-surface/90 leading-relaxed space-y-8">
        <p className="text-xl font-medium leading-relaxed italic text-tertiary border-l-4 border-primary pl-6 py-2">
          "Memory management is the silent heartbeat of every application. Understanding how it evolves is crucial for building high-performance systems."
        </p>
        
        <p>
          Garbage collection (GC) has come a long way since its inception in Lisp in 1959. Today, runtimes like the JVM, Go, and V8 employ sophisticated algorithms that balance throughput, latency, and memory footprint. In this deep dive, we explore the shift from simple Mark-and-Sweep to concurrent, generational, and region-based collectors.
        </p>

        <img 
          src="https://picsum.photos/seed/memory/1200/800" 
          alt="Memory Management Visualization" 
          className="w-full rounded-[2.5rem] shadow-2xl my-12"
          referrerPolicy="no-referrer"
        />

        <h2 className="text-3xl font-black tracking-tight text-on-surface mt-12 mb-6">The Generational Hypothesis</h2>
        <p>
          Most objects die young. This simple observation, known as the generational hypothesis, is the foundation of modern GC design. By dividing the heap into "Young" and "Old" generations, collectors can focus their efforts where they are most likely to reclaim memory quickly.
        </p>

        <div className="bg-surface-container-low p-8 rounded-3xl border border-surface-container-high my-12">
          <h3 className="text-xl font-black tracking-tight text-on-surface mb-4">Key Takeaways</h3>
          <ul className="space-y-4">
            <li className="flex gap-3">
              <div className="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 font-black text-xs">1</div>
              <p className="text-sm font-medium">Generational GC reduces the overhead of scanning long-lived objects.</p>
            </li>
            <li className="flex gap-3">
              <div className="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 font-black text-xs">2</div>
              <p className="text-sm font-medium">Concurrent marking allows the application to run while the GC identifies garbage.</p>
            </li>
            <li className="flex gap-3">
              <div className="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 font-black text-xs">3</div>
              <p className="text-sm font-medium">ZGC and Shenandoah are pushing the boundaries of sub-millisecond pause times.</p>
            </li>
          </ul>
        </div>

        <p>
          As we move towards cloud-native architectures and massive heaps, the challenge for GC designers is to maintain low latency without sacrificing too much CPU throughput. The next decade promises even more innovation in this space.
        </p>
      </div>

      <div className="mt-20 pt-12 border-t border-surface-container-high">
        <h3 className="text-2xl font-black tracking-tight text-on-surface mb-8">Related Articles</h3>
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-8">
          {[1, 2].map((i) => (
            <div key={i} className="group cursor-pointer">
              <div className="aspect-video rounded-3xl overflow-hidden mb-4">
                <img 
                  src={`https://picsum.photos/seed/article${i}/600/400`} 
                  alt="Related Article" 
                  className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  referrerPolicy="no-referrer"
                />
              </div>
              <h4 className="text-lg font-black tracking-tight text-on-surface group-hover:text-primary transition-colors">
                {i === 1 ? 'Understanding the Raft Consensus Algorithm' : 'A Deep Dive into Linux Kernel Namespaces'}
              </h4>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
