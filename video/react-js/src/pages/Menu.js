import React from 'react';

function Menu() {
  return (
    <div className="page-container">
      <h1>Halaman Menu</h1>
      <p>Ini adalah halaman menu kami.</p>
      <div className="menu-content">
        <h3>Menu Makanan</h3>
        <ul>
          <li>Nasi Goreng - Rp 25.000</li>
          <li>Mie Goreng - Rp 20.000</li>
          <li>Ayam Bakar - Rp 35.000</li>
          <li>Sate Ayam - Rp 30.000</li>
        </ul>
        
        <h3>Menu Minuman</h3>
        <ul>
          <li>Es Teh - Rp 5.000</li>
          <li>Es Jeruk - Rp 7.000</li>
          <li>Jus Alpukat - Rp 15.000</li>
          <li>Kopi - Rp 10.000</li>
        </ul>
      </div>
    </div>
  );
}

export default Menu;