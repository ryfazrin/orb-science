import React, { useState } from 'react';
import { Mail, ArrowRight, ArrowLeft, CheckCircle2 } from 'lucide-react';

interface ForgotPasswordProps {
  onPageChange: (page: string) => void;
}

export default function ForgotPassword({ onPageChange }: ForgotPasswordProps) {
  const [isSubmitted, setIsSubmitted] = useState(false);

  return (
    <div className="min-h-[80vh] flex items-center justify-center px-4 py-12">
      <div className="w-full max-w-md">
        <div className="text-center mb-10">
          <h1 className="text-4xl font-black tracking-tighter text-on-surface mb-2">
            {isSubmitted ? 'Check Your Email' : 'Reset Password'}
          </h1>
          <p className="text-tertiary font-medium">
            {isSubmitted 
              ? "We've sent password reset instructions to your email address." 
              : "Enter your email and we'll send you a link to reset your password."}
          </p>
        </div>

        <div className="bg-surface-container-lowest p-8 rounded-[2.5rem] border border-surface-container-high shadow-2xl shadow-primary/5">
          {!isSubmitted ? (
            <form className="space-y-6" onSubmit={(e) => { e.preventDefault(); setIsSubmitted(true); }}>
              <div>
                <label className="block text-xs font-black uppercase tracking-widest text-tertiary mb-2 ml-1">Email Address</label>
                <div className="relative">
                  <Mail className="absolute left-4 top-1/2 -translate-y-1/2 text-tertiary" size={18} />
                  <input 
                    type="email" 
                    required
                    placeholder="name@example.com" 
                    className="w-full pl-12 pr-4 py-3 rounded-2xl bg-surface-container-low border border-transparent focus:border-primary outline-none transition-all font-medium"
                  />
                </div>
              </div>

              <button type="submit" className="w-full py-4 rounded-2xl bg-primary text-white font-black text-lg shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                Send Reset Link <ArrowRight size={20} />
              </button>
            </form>
          ) : (
            <div className="text-center py-4">
              <div className="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <CheckCircle2 size={40} />
              </div>
              <p className="text-on-surface font-medium mb-8">
                Didn't receive the email? Check your spam folder or try again.
              </p>
              <button 
                onClick={() => setIsSubmitted(false)}
                className="w-full py-4 rounded-2xl bg-surface-container-low text-on-surface font-black text-lg hover:bg-surface-container-high transition-all"
              >
                Try Another Email
              </button>
            </div>
          )}

          <div className="mt-8 pt-8 border-t border-surface-container-high text-center">
            <button 
              onClick={() => onPageChange('login')}
              className="inline-flex items-center gap-2 text-primary font-bold hover:underline"
            >
              <ArrowLeft size={18} /> Back to Sign In
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
