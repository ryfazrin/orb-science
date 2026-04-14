import React from 'react';
import { Pencil, Lock, ChevronRight, Award, GraduationCap, Download, HelpCircle } from 'lucide-react';

export default function Profile() {
  return (
    <div className="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
      {/* Profile Hero Section */}
      <header className="mb-12">
        <h1 className="text-5xl font-black tracking-tighter text-on-surface mb-2">Your Profile</h1>
        <p className="text-lg text-tertiary">Manage your account settings and view your achievements.</p>
      </header>

      <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {/* Left Column: Profile Settings Form */}
        <div className="lg:col-span-7 space-y-8">
          <section className="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)] transition-all">
            <div className="flex items-center gap-6 mb-10">
              <div className="relative group">
                <div className="w-24 h-24 rounded-full overflow-hidden ring-4 ring-primary/10">
                  <img 
                    alt="User profile" 
                    className="w-full h-full object-cover" 
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2EKWHJbgGXIRP1_GZapo7v2rVSm3T1fmHdBbMJQrnDcQ79CE2ehci0xPQjFPy-ZSgAjs5s1L7179ozun2D9NyT14pndg04pmUdrP6RagY6vJPFiXTw-w4w1388iCOxLublAvzYDZ1HhfAtO8hdIHlaMhbOZXfSrnfI_DhwVMZFNCqEiC8ymV8_Qe6jmX9fQIk7ijfxMACA4ilh12J3sNhpkv_DttRD0rzN0V4QqrEOB2u39BItlILsyQb1Fwv9p6KPQjKxk1b7il0"
                    referrerPolicy="no-referrer"
                  />
                </div>
                <button className="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform active:scale-90">
                  <Pencil size={16} />
                </button>
              </div>
              <div>
                <h2 className="text-2xl font-black tracking-tight text-on-surface">Change Photo</h2>
                <p className="text-tertiary text-sm font-medium">JPG or PNG. Max size of 800K</p>
              </div>
            </div>

            <form className="space-y-6" onSubmit={(e) => e.preventDefault()}>
              <div className="space-y-2">
                <label className="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Full Name</label>
                <input 
                  className="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                  placeholder="Enter your full name" 
                  type="text" 
                  defaultValue="Aditi Sharma"
                />
              </div>
              <div className="space-y-2">
                <label className="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Email Address</label>
                <input 
                  className="w-full px-6 py-4 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                  placeholder="Enter your email" 
                  type="email" 
                  defaultValue="aditi.sharma@example.com"
                />
              </div>
              <div className="space-y-2">
                <label className="block text-sm font-black uppercase tracking-widest text-tertiary ml-1">Bio</label>
                <textarea 
                  className="w-full px-6 py-4 bg-surface-container rounded-3xl border-none focus:ring-2 focus:ring-primary/20 text-lg font-medium transition-all outline-none" 
                  placeholder="Tell us a bit about yourself..." 
                  rows={3}
                  defaultValue="Aspiring Computer Scientist and lifelong learner. Passionate about AI and community building."
                />
              </div>
              <div className="pt-4">
                <button className="w-full md:w-auto px-10 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all" type="submit">
                  Save Changes
                </button>
              </div>
            </form>
          </section>

          <section className="bg-surface-container-low p-8 rounded-[2rem] border border-surface-container-high">
            <h2 className="text-xl font-black tracking-tight text-on-surface mb-6">Security</h2>
            <div className="flex items-center justify-between p-6 bg-surface-container-lowest rounded-2xl hover:shadow-md transition-all cursor-pointer group">
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                  <Lock size={20} />
                </div>
                <div>
                  <p className="font-black text-on-surface">Password</p>
                  <p className="text-sm text-tertiary font-medium">Last changed 3 months ago</p>
                </div>
              </div>
              <ChevronRight size={24} className="text-tertiary group-hover:text-primary transition-colors" />
            </div>
          </section>
        </div>

        {/* Right Column: Certificates & Stats */}
        <div className="lg:col-span-5 space-y-8">
          <section className="bg-surface-container-lowest p-8 rounded-[2rem] shadow-[0px_4px_24px_rgba(27,28,28,0.06)]">
            <div className="flex justify-between items-end mb-8">
              <h2 className="text-2xl font-black tracking-tight text-on-surface">Your Certificates</h2>
              <span className="text-primary font-bold text-sm cursor-pointer hover:underline">View All</span>
            </div>
            <div className="space-y-4">
              {/* Certificate Card 1 */}
              <div className="group bg-surface-container-low p-4 rounded-2xl flex items-center gap-4 hover:bg-surface-container-high transition-colors">
                <div className="w-16 h-16 rounded-xl bg-white overflow-hidden flex-shrink-0 shadow-sm flex items-center justify-center">
                  <div className="w-full h-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <Award size={32} />
                  </div>
                </div>
                <div className="flex-grow">
                  <p className="font-black text-on-surface leading-tight">Data Structures Masterclass</p>
                  <p className="text-sm text-tertiary font-medium">Issued July 2024</p>
                </div>
                <button className="p-2 rounded-full hover:bg-white text-tertiary hover:text-primary transition-all">
                  <Download size={20} />
                </button>
              </div>
              {/* Certificate Card 2 */}
              <div className="group bg-surface-container-low p-4 rounded-2xl flex items-center gap-4 hover:bg-surface-container-high transition-colors">
                <div className="w-16 h-16 rounded-xl bg-white overflow-hidden flex-shrink-0 shadow-sm flex items-center justify-center">
                  <div className="w-full h-full bg-primary/10 flex items-center justify-center text-primary">
                    <GraduationCap size={32} />
                  </div>
                </div>
                <div className="flex-grow">
                  <p className="font-black text-on-surface leading-tight">Foundations of CS</p>
                  <p className="text-sm text-tertiary font-medium">Issued May 2024</p>
                </div>
                <button className="p-2 rounded-full hover:bg-white text-tertiary hover:text-primary transition-all">
                  <Download size={20} />
                </button>
              </div>
            </div>

            {/* Learning Stats Bento */}
            <div className="mt-8 grid grid-cols-2 gap-4">
              <div className="bg-secondary/10 p-6 rounded-2xl text-secondary">
                <p className="text-xs font-black uppercase tracking-widest opacity-70">Courses Done</p>
                <p className="text-4xl font-black mt-2">12</p>
              </div>
              <div className="bg-primary/10 p-6 rounded-2xl text-primary">
                <p className="text-xs font-black uppercase tracking-widest opacity-70">Hours Spent</p>
                <p className="text-4xl font-black mt-2">148</p>
              </div>
            </div>
          </section>

          {/* Help Card */}
          <section className="bg-on-surface text-surface p-8 rounded-[2rem] relative overflow-hidden group">
            <div className="relative z-10">
              <h3 className="text-2xl font-black tracking-tight mb-2">Need Help?</h3>
              <p className="opacity-80 mb-6 text-sm font-medium">Our support team is here to help you 24/7 with any platform issues.</p>
              <button className="bg-surface text-on-surface px-8 py-3 rounded-full font-black text-sm hover:scale-105 active:scale-95 transition-all">
                Contact Support
              </button>
            </div>
            <div className="absolute -right-6 -bottom-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
              <HelpCircle size={160} />
            </div>
          </section>
        </div>
      </div>
    </div>
  );
}
