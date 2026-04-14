import React from 'react';
import { CheckCircle, ShieldCheck, Infinity, CreditCard, Lock, RefreshCcw, DollarSign } from 'lucide-react';

interface PricingProps {
  onPageChange: (page: string) => void;
}

export default function Pricing({ onPageChange }: PricingProps) {
  return (
    <div className="pt-12 pb-24 px-6 md:px-8 max-w-7xl mx-auto overflow-hidden">
      {/* Hero Section */}
      <div className="text-center mb-32 space-y-6">
        <h1 className="text-6xl md:text-8xl font-black tracking-tighter text-on-surface leading-[0.9]">
          Knowledge that <span className="text-primary italic">sticks.</span>
        </h1>
        <p className="text-xl md:text-2xl text-tertiary max-w-2xl mx-auto font-medium leading-relaxed">
          Choose a plan that fits your learning journey. Empowering non-tech minds with crystal-clear digital wisdom.
        </p>
      </div>

      {/* Pricing Grid */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-12 items-end mb-40">
        {/* Monthly Plan */}
        <div className="bg-surface-container-low p-12 rounded-[3rem] space-y-10 flex flex-col h-full hover:scale-[1.02] transition-transform duration-500 border border-surface-container-high">
          <div className="space-y-3">
            <h3 className="text-3xl font-black tracking-tight">Monthly</h3>
            <p className="text-tertiary font-medium">Flexible access to everything.</p>
          </div>
          <div className="flex items-baseline gap-2">
            <span className="text-5xl font-black tracking-tighter">$29</span>
            <span className="text-tertiary font-black uppercase tracking-widest text-xs">/mo</span>
          </div>
          <ul className="space-y-5 flex-grow">
            {[
              'Unlimited Course Access',
              'Community Forum Access',
              'Weekly Newsletter'
            ].map((feature, i) => (
              <li key={i} className="flex items-center gap-4">
                <CheckCircle size={20} className="text-primary" />
                <span className="text-sm font-bold text-on-surface">{feature}</span>
              </li>
            ))}
          </ul>
          <button 
            onClick={() => onPageChange('register')}
            className="w-full py-5 px-8 rounded-full font-black text-on-surface border-2 border-on-surface/10 hover:bg-on-surface/5 transition-all uppercase tracking-widest text-xs"
          >
            Start Monthly
          </button>
        </div>

        {/* Yearly Plan (Best Value) */}
        <div className="relative bg-surface-container-lowest p-12 rounded-[3rem] shadow-[0px_40px_80px_rgba(188,1,0,0.15)] border-2 border-primary/20 space-y-10 flex flex-col h-[110%] scale-105 z-10 hover:scale-[1.07] transition-transform duration-500">
          <div className="absolute -top-6 left-1/2 -translate-x-1/2 bg-primary text-white px-8 py-2 rounded-full text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-primary/20">
            Best Value
          </div>
          <div className="space-y-3">
            <h3 className="text-3xl font-black tracking-tight">Yearly</h3>
            <p className="text-tertiary font-medium">Our most popular learning path.</p>
          </div>
          <div className="flex items-baseline gap-2">
            <span className="text-7xl font-black tracking-tighter">$249</span>
            <span className="text-tertiary font-black uppercase tracking-widest text-xs">/yr</span>
          </div>
          <ul className="space-y-5 flex-grow">
            {[
              'Everything in Monthly',
              'Offline Video Downloads',
              'Exclusive Webinars',
              'Priority Support'
            ].map((feature, i) => (
              <li key={i} className="flex items-center gap-4">
                <ShieldCheck size={24} className="text-primary" fill="currentColor" fillOpacity="0.1" />
                <span className="text-base font-black text-on-surface">{feature}</span>
              </li>
            ))}
          </ul>
          <button 
            onClick={() => onPageChange('register')}
            className="w-full py-6 px-8 rounded-full font-black text-white bg-primary hover:opacity-90 active:scale-95 transition-all shadow-2xl shadow-primary/30 uppercase tracking-widest text-sm"
          >
            Get Yearly Access
          </button>
        </div>

        {/* Lifetime Access */}
        <div className="bg-surface-container-low p-12 rounded-[3rem] space-y-10 flex flex-col h-full hover:scale-[1.02] transition-transform duration-500 border border-surface-container-high">
          <div className="space-y-3">
            <h3 className="text-3xl font-black tracking-tight">Lifetime Access</h3>
            <p className="text-tertiary font-medium">One payment, forever wisdom.</p>
          </div>
          <div className="flex items-baseline gap-2">
            <span className="text-5xl font-black tracking-tighter">$599</span>
            <span className="text-tertiary font-black uppercase tracking-widest text-xs">once</span>
          </div>
          <ul className="space-y-5 flex-grow">
            {[
              'Lifetime Course Access',
              'All Future Courses Included',
              'Private Discord Access'
            ].map((feature, i) => (
              <li key={i} className="flex items-center gap-4">
                <Infinity size={20} className="text-primary" />
                <span className="text-sm font-bold text-on-surface">{feature}</span>
              </li>
            ))}
          </ul>
          <button 
            onClick={() => onPageChange('register')}
            className="w-full py-5 px-8 rounded-full font-black text-on-surface border-2 border-on-surface/10 hover:bg-on-surface/5 transition-all uppercase tracking-widest text-xs"
          >
            Join Lifetime
          </button>
        </div>
      </div>

      {/* Bento FAQ Section */}
      <div className="mt-60 space-y-16">
        <div className="text-center space-y-4">
          <h2 className="text-5xl font-black tracking-tighter">Payment FAQ</h2>
          <p className="text-xl text-tertiary font-medium">Everything you need to know about your investment.</p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-12 gap-8">
          {/* Large Question Card */}
          <div className="md:col-span-8 bg-surface-container-low p-12 rounded-[2.5rem] border border-surface-container-high">
            <div className="flex gap-6">
              <CreditCard size={32} className="text-primary flex-shrink-0" />
              <div className="space-y-4">
                <h4 className="text-2xl font-black tracking-tight">What payment methods do you accept?</h4>
                <p className="text-tertiary font-medium leading-relaxed text-lg">
                  We accept all major credit cards including Visa, Mastercard, and American Express. Additionally, we support PayPal and Apple Pay for a seamless checkout experience. All transactions are encrypted and processed through industry-standard secure gateways.
                </p>
              </div>
            </div>
          </div>
          {/* Small Info Card */}
          <div className="md:col-span-4 bg-primary text-white p-12 rounded-[2.5rem] flex flex-col justify-between shadow-2xl shadow-primary/20">
            <h4 className="text-2xl font-black tracking-tight">Safe & Secure</h4>
            <p className="text-base font-medium opacity-90 leading-relaxed">Your data is protected by 256-bit SSL encryption. We never store your full credit card details.</p>
            <Lock size={48} className="opacity-20 self-end" />
          </div>
          {/* Small Question Card */}
          <div className="md:col-span-6 bg-surface-container-high p-10 rounded-[2.5rem]">
            <div className="flex gap-6">
              <RefreshCcw size={24} className="text-primary flex-shrink-0" />
              <div className="space-y-3">
                <h4 className="text-xl font-black tracking-tight">Can I cancel anytime?</h4>
                <p className="text-tertiary font-medium leading-relaxed">Yes, absolutely. You can cancel your Monthly or Yearly subscription at any time from your account settings with just two clicks. You'll keep access until the end of your billing cycle.</p>
              </div>
            </div>
          </div>
          {/* Small Question Card */}
          <div className="md:col-span-6 bg-surface-container-high p-10 rounded-[2.5rem]">
            <div className="flex gap-6">
              <DollarSign size={24} className="text-primary flex-shrink-0" />
              <div className="space-y-3">
                <h4 className="text-xl font-black tracking-tight">Do you offer refunds?</h4>
                <p className="text-tertiary font-medium leading-relaxed">We provide a 14-day no-questions-asked money-back guarantee. If Ilmu Komputer isn't the right fit for you, just email us and we'll process your refund immediately.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Trust Section */}
      <div className="mt-40 p-16 bg-surface-container-lowest rounded-[3rem] text-center space-y-12 border border-surface-container-high">
        <h4 className="text-tertiary font-black uppercase tracking-[0.3em] text-xs">Trusted by learners from</h4>
        <div className="flex flex-wrap justify-center gap-16 opacity-30 grayscale contrast-125">
          {['Google', 'Meta', 'Amazon', 'Stripe', 'Notion'].map((brand) => (
            <span key={brand} className="text-3xl font-black tracking-tighter">{brand}</span>
          ))}
        </div>
      </div>
    </div>
  );
}
