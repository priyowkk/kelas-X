import React from 'react';
import { Link } from 'react-router-dom';
// CSS sekarang diimpor dari public/style.css

function Navbar() {
  return (
    <nav className="navbar">
      <ul className="nav-links">
        <li><Link to="/">Home</Link></li>
        <li><Link to="/kontak">Kontak</Link></li>
        <li><Link to="/nav">Nav</Link></li>
        <li><Link to="/sejarah">Sejarah</Link></li>
        <li><Link to="/tentang">Tentang</Link></li>
        <li><Link to="/siswa">Siswa</Link></li>
        <li><Link to="/menu">Menu</Link></li>
      </ul>
    </nav>
  );
}

export default Navbar;