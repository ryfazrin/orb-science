import React from 'react';
import { Github, Mail, Lock, ArrowRight } from 'lucide-react';

interface LoginProps {
  onPageChange: (page: string) => void;
}

export default function Login({ onPageChange }: LoginProps) {
  return (
    <div className="min-h-[80vh] flex items-center justify-center px-4 py-12">
      <div className="w-full max-w-md">
        <div className="text-center mb-10">
          <h1 className="text-4xl font-black tracking-tighter text-on-surface mb-2">Welcome Back</h1>
          <p className="text-tertiary font-medium">Continue your journey into computer science.</p>
        </div>

        <div className="bg-surface-container-low p-8 rounded-[2.5rem] border border-surface-container-high shadow-2xl shadow-primary/5">
          <form className="space-y-6" onSubmit={(e) => e.preventDefault()}>
            <div>
              <label className="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Email Address</label>
              <div className="relative">
                <Mail className="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary" size={18} />
                <input 
                  type="email" 
                  placeholder="name@example.com" 
                  className="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border border-transparent focus:border-primary outline-none transition-all font-medium"
                />
              </div>
            </div>

            <div>
              <label className="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Password</label>
              <div className="relative">
                <Lock className="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary" size={18} />
                <input 
                  type="password" 
                  placeholder="••••••••" 
                  className="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-high border border-transparent focus:border-primary outline-none transition-all font-medium"
                />
              </div>
            </div>

            <div className="flex items-center justify-between text-sm">
              <label className="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" className="w-4 h-4 rounded border-surface-container-high text-primary focus:ring-primary" />
                <span className="text-tertiary font-bold group-hover:text-on-surface transition-colors">Remember me</span>
              </label>
              <button 
                onClick={() => onPageChange('forgot-password')}
                className="text-primary font-bold hover:underline"
              >
                Forgot password?
              </button>
            </div>

            <button className="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
              Sign In <ArrowRight size={20} />
            </button>
          </form>

          <div className="relative my-10">
            <div className="absolute inset-0 flex items-center">
              <div className="w-full border-t border-surface-container-high"></div>
            </div>
            <div className="relative flex justify-center text-xs font-black uppercase tracking-widest">
              <span className="bg-surface-container-low px-4 text-tertiary">Or continue with</span>
            </div>
          </div>

          <div className="grid grid-cols-2 gap-4">
            <button className="flex items-center justify-center gap-2 py-3 rounded-2xl border border-surface-container-high font-bold text-on-surface hover:bg-surface-container-high transition-all">
              <div className="flex items-center gap-2">
                <Github size={20} /> GitHub
              </div>
            </button>
            <button className="flex items-center justify-center gap-2 py-3 rounded-2xl border border-surface-container-high font-bold text-on-surface hover:bg-surface-container-high transition-all">
              <div className="flex items-center gap-2">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                  <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                  <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                  <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg> Google
              </div>
            </button>
          </div>
        </div>

        <p className="text-center mt-8 text-sm font-medium text-tertiary">
          Don't have an account? <button onClick={() => onPageChange('register')} className="text-primary font-bold hover:underline">Create one for free</button>
        </p>
      </div>
    </div>
  );
}
