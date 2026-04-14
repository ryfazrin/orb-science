import React from 'react';
import { Eye, Rocket, ArrowRight } from 'lucide-react';

interface AboutUsProps {
  onPageChange: (page: string) => void;
}

export default function AboutUs({ onPageChange }: AboutUsProps) {
  return (
    <div className="pt-12 pb-20">
      {/* Hero Section */}
      <section className="max-w-7xl mx-auto px-8 mb-32">
        <div className="max-w-3xl">
          <span className="text-primary font-black tracking-[0.2em] text-xs mb-6 block uppercase">Our Essence</span>
          <h1 className="text-6xl md:text-8xl font-black text-on-surface tracking-tighter leading-[0.9] mb-10">
            Democratizing <span className="text-primary">technology</span> for every curious mind.
          </h1>
          <p className="text-2xl text-tertiary leading-relaxed mb-12 font-medium max-w-2xl">
            We believe that digital literacy isn't just for engineers. It's the new universal language of the modern world.
          </p>
        </div>
        <div className="relative h-[600px] rounded-[3rem] overflow-hidden mt-16 shadow-2xl">
          <img 
            className="w-full h-full object-cover" 
            src="https://picsum.photos/seed/about-hero/1600/900" 
            alt="Team collaboration"
            referrerPolicy="no-referrer"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
          <div className="absolute bottom-16 left-16 right-16">
            <div className="bg-white/10 backdrop-blur-2xl p-10 rounded-[2rem] border border-white/20 max-w-lg">
              <p className="text-white text-2xl font-bold italic leading-relaxed">
                "Bridging the gap between human intuition and digital complexity."
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Our Story */}
      <section className="bg-surface-container-low py-32 px-8 border-y border-surface-container-high">
        <div className="max-w-7xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <div className="lg:col-span-5 flex flex-col justify-center">
              <h2 className="text-5xl font-black mb-10 tracking-tighter leading-tight">
                The Genesis of <br />
                <span className="text-primary">Ilmu Komputer</span>
              </h2>
              <p className="text-xl text-tertiary mb-8 leading-relaxed font-medium">
                Starting in a small shared workspace, we noticed a recurring pattern: brilliant professionals were being sidelined by the rapid evolution of technology. We decided to change that.
              </p>
              <p className="text-xl text-tertiary leading-relaxed font-medium">
                Our mission is to translate complex technical concepts into actionable knowledge for the non-tech majority, empowering them to lead in the digital era.
              </p>
            </div>
            <div className="lg:col-span-6 lg:col-start-7">
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div className="bg-surface-container-lowest p-12 rounded-[2.5rem] shadow-2xl shadow-primary/5 flex flex-col gap-6 border border-surface-container-high">
                  <div className="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                    <Eye size={32} />
                  </div>
                  <h3 className="text-3xl font-black tracking-tight">Our Vision</h3>
                  <p className="text-tertiary font-medium leading-relaxed">To become the global standard for accessible, premium digital education for non-technical leadership.</p>
                </div>
                <div className="bg-surface-container-lowest p-12 rounded-[2.5rem] shadow-2xl shadow-primary/5 flex flex-col gap-6 border border-surface-container-high sm:mt-16">
                  <div className="w-16 h-16 rounded-2xl bg-secondary-container/20 flex items-center justify-center text-secondary-container">
                    <Rocket size={32} />
                  </div>
                  <h3 className="text-3xl font-black tracking-tight">Our Mission</h3>
                  <p className="text-tertiary font-medium leading-relaxed">Empowering individuals through curated, high-impact learning paths that stick.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Meet the Team */}
      <section className="max-w-7xl mx-auto px-8 py-32">
        <div className="text-center mb-24">
          <h2 className="text-6xl font-black tracking-tighter mb-6">The Minds Behind the Screen</h2>
          <p className="text-2xl text-tertiary max-w-2xl mx-auto font-medium">A collective of educators, designers, and engineers dedicated to your growth.</p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-16">
          {[
            { 
              name: 'Adrian Wijaya', 
              role: 'CEO & Curriculum Lead', 
              tag: 'Founder', 
              color: 'bg-primary',
              desc: 'Ex-Product at Stripe. Passionate about teaching complex algorithms through storytelling and visual metaphors.'
            },
            { 
              name: 'Sarah Chen', 
              role: 'Head of Design', 
              tag: 'Co-Founder', 
              color: 'bg-secondary-container',
              desc: 'Award-winning UI designer with a decade of experience in making digital tools intuitive for everyone.'
            },
            { 
              name: 'Marcus Thorne', 
              role: 'Technical Evangelist', 
              tag: 'Lead Instructor', 
              color: 'bg-tertiary',
              desc: 'A software architect who believes that code is a creative medium for problem solving, not just syntax.'
            }
          ].map((member, i) => (
            <div key={i} className="group">
              <div className="aspect-[4/5] rounded-[2.5rem] overflow-hidden mb-8 relative shadow-xl">
                <img 
                  className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                  src={`https://picsum.photos/seed/team${i}/600/800`} 
                  alt={member.name}
                  referrerPolicy="no-referrer"
                />
                <div className={`absolute bottom-6 left-6 ${member.color} text-white px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest`}>
                  {member.tag}
                </div>
              </div>
              <h3 className="text-3xl font-black mb-2 tracking-tight">{member.name}</h3>
              <p className="text-primary font-black text-xs uppercase tracking-widest mb-6">{member.role}</p>
              <p className="text-tertiary font-medium leading-relaxed">{member.desc}</p>
            </div>
          ))}
        </div>
      </section>

      {/* Why We Do This */}
      <section className="max-w-7xl mx-auto px-8 py-32 border-t border-surface-container-high">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-20 items-center">
          <div className="lg:col-span-4">
            <h2 className="text-6xl font-black tracking-tighter mb-8 leading-[0.9]">The "Why" behind every lesson.</h2>
            <p className="text-xl text-tertiary leading-relaxed mb-10 font-medium">We measure our success not by revenue, but by the confidence of our students when they walk into a technical boardroom.</p>
            <button className="flex items-center gap-3 text-primary font-black uppercase tracking-widest text-sm hover:gap-5 transition-all">
              Read our impact report
              <ArrowRight size={20} />
            </button>
          </div>
          <div className="lg:col-span-7 lg:col-start-6">
            <div className="space-y-16">
              {[
                { id: '01', title: 'Eliminating Technical Anxiety', desc: 'We help professionals overcome the fear of "breaking things" and replace it with a mental model of how systems actually work.' },
                { id: '02', title: 'Leveling the Playing Field', desc: 'By providing high-quality digital education, we ensure that career advancement isn\'t limited by a person\'s initial choice of major.' },
                { id: '03', title: 'Fostering Innovation', desc: 'When non-tech experts understand tech, they create hybrid solutions that pure engineers could never imagine.' }
              ].map((item) => (
                <div key={item.id} className="flex gap-10">
                  <span className="text-7xl font-black text-primary/10 leading-none">{item.id}</span>
                  <div>
                    <h4 className="text-2xl font-black mb-3 tracking-tight">{item.title}</h4>
                    <p className="text-tertiary font-medium leading-relaxed">{item.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Final CTA */}
      <section className="max-w-7xl mx-auto px-8 py-32">
        <div className="bg-primary text-white p-20 rounded-[3rem] relative overflow-hidden text-center shadow-2xl shadow-primary/20">
          <div className="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
          <h2 className="text-5xl md:text-7xl font-black mb-10 relative z-10 tracking-tighter">Ready to start your journey?</h2>
          <div className="flex flex-wrap justify-center gap-8 relative z-10">
            <button 
              onClick={() => onPageChange('catalog')}
              className="bg-white text-primary px-12 py-5 rounded-full font-black text-lg hover:scale-105 transition-transform shadow-xl"
            >
              Explore Courses
            </button>
            <button 
              onClick={() => onPageChange('support')}
              className="border-2 border-white text-white px-12 py-5 rounded-full font-black text-lg hover:bg-white/10 transition-colors"
            >
              Contact Us
            </button>
          </div>
        </div>
      </section>
    </div>
  );
}
