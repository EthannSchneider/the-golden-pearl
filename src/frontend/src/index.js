import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import Home from './pages/home/home';
import DailyMenu from './pages/daily_menu/daily_menu';
import Header from './components/header/header';
import Footer from './components/footer/footer';
import NotFound from './pages/not_found/not_found';
import Login from './pages/admin/login/login';
import Admin from './pages/admin/admin';
import Meals from './pages/admin/meals/meals';
import MealsEdit from './pages/admin/meals/edit/meals_edit'
import AdminDailyMenu from './pages/admin/dailymenu/daily_menu'
import AdminDailyMenuEdit from './pages/admin/dailymenu/edit/daily_menu_edit'
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

        <Route path="admin" element={<Admin/>} />
        <Route path="admin/meals" element={<Meals/>} />
        <Route path="admin/meals/:name" element={<MealsEdit/>} />
        <Route path="admin/dailyMenu" element={<AdminDailyMenu/>} />
        <Route path="admin/dailyMenu/:name" element={<AdminDailyMenuEdit/>} />
        <Route path="admin/login" element={<Login />} />
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
