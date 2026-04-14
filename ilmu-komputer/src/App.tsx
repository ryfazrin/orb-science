import React, { useState } from 'react';
import Layout from './components/Layout';
import Landing from './components/Landing';
import Catalog from './components/Catalog';
import Dashboard from './components/Dashboard';
import Article from './components/Article';
import Login from './components/Login';
import Profile from './components/Profile';
import LessonDetail from './components/LessonDetail';
import LearningPath from './components/LearningPath';
import Register from './components/Register';
import ForgotPassword from './components/ForgotPassword';
import CourseDetail from './components/CourseDetail';
import AboutUs from './components/AboutUs';
import Support from './components/Support';
import Pricing from './components/Pricing';

export default function App() {
  const [currentPage, setCurrentPage] = useState('landing');
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  const renderPage = () => {
    switch (currentPage) {
      case 'landing':
        return <Landing onPageChange={handlePageChange} />;
      case 'catalog':
        return <Catalog onPageChange={handlePageChange} />;
      case 'dashboard':
        return <Dashboard onPageChange={handlePageChange} />;
      case 'article':
        return <Article />;
      case 'login':
        return <Login onPageChange={handlePageChange} />;
      case 'register':
        return <Register onPageChange={handlePageChange} />;
      case 'forgot-password':
        return <ForgotPassword onPageChange={handlePageChange} />;
      case 'profile':
        return <Profile />;
      case 'lesson':
        return <LessonDetail onPageChange={handlePageChange} />;
      case 'pathway':
        return <LearningPath onPageChange={handlePageChange} />;
      case 'course-detail':
        return <CourseDetail onPageChange={handlePageChange} />;
      case 'about':
        return <AboutUs onPageChange={handlePageChange} />;
      case 'support':
        return <Support onPageChange={handlePageChange} />;
      case 'pricing':
        return <Pricing onPageChange={handlePageChange} />;
      default:
        return <Landing onPageChange={handlePageChange} />;
    }
  };

  const handlePageChange = (page: string) => {
    setCurrentPage(page);
    window.scrollTo(0, 0);
    
    // Simulate login for demo purposes when going to dashboard
    if (page === 'dashboard' || page === 'profile') {
      setIsLoggedIn(true);
    }
  };

  return (
    <Layout 
      currentPage={currentPage} 
      onPageChange={handlePageChange}
      isLoggedIn={isLoggedIn}
    >
      {renderPage()}
    </Layout>
  );
}
