import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import Home from './pages/home/home';
import DailyMenu from './pages/daily_menu/daily_menu';
import Header from './components/header/header';
import Footer from './components/footer/footer';
import NotFound from './pages/not_found/not_found';
import WhoAreWe from './pages/who_are_we/who_are_we';
import {
  Route,
  BrowserRouter,
  Routes
} from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js"


export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="daily_menu" element={<DailyMenu />} />
        <Route path="who_are_we" element={<WhoAreWe />} />
        <Route path="*" element={<NotFound />} />
      </Routes>
   </BrowserRouter>
  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <Header />
    <App />
    <Footer />
  </React.StrictMode>
);
