import React from 'react';
import { LogOut, User, Menu } from 'lucide-react';

interface LayoutProps {
  children: React.ReactNode;
  currentPage: string;
  onPageChange: (page: string) => void;
  isLoggedIn: boolean;
}

export default function Layout({ children, currentPage, onPageChange, isLoggedIn }: LayoutProps) {
  return (
    <div className="min-h-screen flex flex-col bg-surface text-on-surface">
      {/* Header */}
      <header className="sticky top-0 z-50 w-full bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
          <div 
            className="flex items-center gap-3 cursor-pointer" 
            onClick={() => onPageChange('landing')}
          >
            <div className="text-primary">
              <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z" fill="currentColor"/>
              </svg>
            </div>
            <h1 className="text-2xl font-black tracking-tighter text-primary">Ilmu Komputer</h1>
          </div>

          <nav className="hidden md:flex items-center gap-8">
            <button 
              onClick={() => onPageChange('landing')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'landing' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Home
            </button>
            <button 
              onClick={() => onPageChange('catalog')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'catalog' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Catalog
            </button>
            <button 
              onClick={() => onPageChange('dashboard')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'dashboard' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Dashboard
            </button>
            <button 
              onClick={() => onPageChange('article')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'article' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Articles
            </button>
            <button 
              onClick={() => onPageChange('pricing')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'pricing' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Pricing
            </button>
            <button 
              onClick={() => onPageChange('about')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'about' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              About Us
            </button>
            <button 
              onClick={() => onPageChange('lesson')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'lesson' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Lessons
            </button>
            <button 
              onClick={() => onPageChange('pathway')}
              className={`text-sm font-semibold tracking-tight transition-colors ${currentPage === 'pathway' ? 'text-primary' : 'text-tertiary hover:text-on-surface'}`}
            >
              Pathways
            </button>
          </nav>

          <div className="flex items-center gap-4">
            {isLoggedIn ? (
              <>
                <button 
                  onClick={() => onPageChange('profile')}
                  className="flex items-center gap-2 px-4 py-2 rounded-full font-bold text-tertiary hover:bg-surface-container-low transition-colors"
                >
                  <User size={18} />
                  <span className="hidden sm:inline">Profile</span>
                </button>
                <button className="flex items-center gap-2 px-4 py-2 rounded-full font-bold bg-primary text-white shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
                  <LogOut size={18} />
                  <span className="hidden sm:inline">Log Out</span>
                </button>
              </>
            ) : (
              <>
                <button 
                  onClick={() => onPageChange('login')}
                  className="px-6 py-2 rounded-full font-bold text-primary hover:bg-surface-container-low transition-colors"
                >
                  Sign In
                </button>
                <button 
                  onClick={() => onPageChange('register')}
                  className="px-6 py-2 rounded-full font-bold bg-primary text-white shadow-lg hover:shadow-primary/20 active:scale-95 transition-all"
                >
                  Get Started
                </button>
              </>
            )}
            <button className="md:hidden p-2 text-tertiary">
              <Menu size={24} />
            </button>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex-grow">
        {children}
      </main>

      {/* Footer */}
      {currentPage !== 'lesson' && (
        <footer className="bg-surface-container-low py-12 border-t border-surface-container-high">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="flex flex-col md:flex-row justify-between items-center gap-8">
              <div className="flex flex-col items-center md:items-start gap-2">
                <span className="font-bold text-xl text-on-surface">Ilmu Komputer</span>
                <p className="text-sm text-tertiary">© 2024 Ilmu Komputer. Curating the future of CS.</p>
              </div>
              <div className="flex gap-8">
                <button 
                  onClick={() => onPageChange('support')}
                  className="text-sm font-medium text-tertiary hover:text-primary transition-colors"
                >
                  Contact
                </button>
                <button 
                  onClick={() => onPageChange('about')}
                  className="text-sm font-medium text-tertiary hover:text-primary transition-colors"
                >
                  About
                </button>
                <button 
                  onClick={() => onPageChange('support')}
                  className="text-sm font-medium text-tertiary hover:text-primary transition-colors"
                >
                  Support
                </button>
              </div>
            </div>
          </div>
        </footer>
      )}
    </div>
  );
}
