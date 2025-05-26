import React, { useState, useEffect } from 'react';
import './App.css';
import Contact from './Contact';
import Order from './Order';
import Register from './Register';
import Login from './Login';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import AdminDashboard from './components/AdminDashboard';

function App() {
  
  
  const [showDropdown, setShowDropdown] = useState(false);
  const [currentPage, setCurrentPage] = useState('home');
  const [user, setUser] = useState(null); // State untuk menyimpan data user yang login
  const [isLoggedIn, setIsLoggedIn] = useState(false); // State untuk status login
  const [menuItems, setMenuItems] = useState([]); // State untuk menyimpan data menu dari database
  const [loading, setLoading] = useState(false); // State untuk loading
  const [error, setError] = useState(null); // State untuk error handling

  // Check if user is already logged in when app loads
  useEffect(() => {
    const savedUser = localStorage.getItem('user');
    if (savedUser) {
      const userData = JSON.parse(savedUser);
      setUser(userData);
      setIsLoggedIn(true);
    }
  }, []);

  // Fungsi untuk mengambil data menu dari database
// Bagian untuk mengganti fungsi fetchMenuItems di App.js

// Fungsi untuk mengambil data menu dari database - DIPERBAIKI
const fetchMenuItems = async () => {
  setLoading(true);
  setError(null);
  
  try {
    console.log('Fetching menu from API...');
    const response = await fetch('http://localhost:3001/api/menu', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
      // Tambahkan timeout
      signal: AbortSignal.timeout(10000) // 10 detik timeout
    });
    
    console.log('Response status:', response.status);
    console.log('Response headers:', response.headers);
    
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    const result = await response.json();
    console.log('API Response:', result);
    
    // Periksa struktur response
    if (result.success && result.data) {
      // Jika response memiliki format { success: true, data: [...] }
      setMenuItems(result.data);
      console.log('Menu items set:', result.data.length, 'items');
    } else if (Array.isArray(result)) {
      // Jika response langsung berupa array
      setMenuItems(result);
      console.log('Menu items set:', result.length, 'items');
    } else {
      throw new Error('Format response tidak sesuai');
    }
    
  } catch (err) {
    console.error('Error fetching menu items:', err);
    
    if (err.name === 'AbortError') {
      setError('Koneksi timeout. Periksa koneksi internet Anda.');
    } else if (err.message.includes('Failed to fetch')) {
      setError('Tidak dapat terhubung ke server. Pastikan backend berjalan di http://localhost:3001');
    } else {
      setError(`Gagal memuat data menu: ${err.message}`);
    }
    
    // Fallback data jika API tidak tersedia
    console.log('Using fallback menu data');
    setMenuItems([
      { 
        id_menu: 1, 
        nama: 'Nasi Goreng Spesial', 
        harga: 25000, 
        stok: 10, 
        gambar: '/images/nasi-goreng.jpg' 
      },
      { 
        id_menu: 2, 
        nama: 'Mie Ayam Pangsit', 
        harga: 20000, 
        stok: 15, 
        gambar: '/images/mie-ayam.jpg' 
      },
      { 
        id_menu: 3, 
        nama: 'Sate Ayam', 
        harga: 30000, 
        stok: 8, 
        gambar: '/images/sate-ayam.jpg' 
      },
      { 
        id_menu: 4, 
        nama: 'Es Teh Manis', 
        harga: 5000, 
        stok: 20, 
        gambar: '/images/es-teh.jpg' 
      },
    ]);
  } finally {
    setLoading(false);
  }
};

// Tambahkan juga fungsi untuk test koneksi API
const testApiConnection = async () => {
  try {
    const response = await fetch('http://localhost:3001/api/test-db');
    const result = await response.json();
    console.log('API Test Result:', result);
    
    if (result.success) {
      alert('Koneksi ke database berhasil!');
    } else {
      alert('Koneksi database gagal: ' + result.message);
    }
  } catch (error) {
    console.error('API Test Error:', error);
    alert('Tidak dapat terhubung ke server backend');
  }
};

  // Load menu items ketika halaman menu dibuka
  useEffect(() => {
    if (currentPage === 'menu') {
      fetchMenuItems();
    }
  }, [currentPage]);

  const toggleDropdown = () => setShowDropdown(prev => !prev);
  const goToHome = () => setCurrentPage('home');
  const goToMenu = () => setCurrentPage('menu');
  const goToContact = () => setCurrentPage('contact');
  const goToOrder = () => setCurrentPage('order');
  const goToRegister = () => setCurrentPage('register');
  const goToLogin = () => setCurrentPage('login');

  // === TAMBAHAN UNTUK ADMIN DASHBOARD ===
  const goToAdmin = () => setCurrentPage('admin');
  
  // Fungsi untuk cek apakah user adalah admin
  const isAdmin = () => {
    return user && (user.username === 'admin' || user.role === 'admin');
  };

  // Fungsi untuk handle login berhasil
  const handleLoginSuccess = (userData) => {
    setUser(userData);
    setIsLoggedIn(true);
    setCurrentPage('home'); // Redirect ke home setelah login
    setShowDropdown(false); // Tutup dropdown
  };

  // Fungsi untuk handle logout
  const handleLogout = () => {
    localStorage.removeItem('user');
    setUser(null);
    setIsLoggedIn(false);
    setCurrentPage('home');
    setShowDropdown(false);
    alert('Anda telah logout');
  };

  // Fungsi untuk format harga ke Rupiah
  const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(price);
    
  };

  return (
    <div className="app">
      {/* Navbar */}
      <header className="navbar">
        <h1>Restoran Lezat</h1>
        <nav>
          <a href="#" onClick={e => { e.preventDefault(); goToHome(); }}>Beranda</a>
          <a href="#" onClick={e => { e.preventDefault(); goToMenu(); }}>Menu</a>
          <a href="#" onClick={e => { e.preventDefault(); goToContact(); }}>Kontak</a>
          <a href="#" onClick={e => { e.preventDefault(); goToOrder(); }}>Pesanan</a>
          
          {/* TAMBAHAN: Link Admin hanya tampil untuk admin */}
          {isLoggedIn && isAdmin() && (
            <a href="#" onClick={e => { e.preventDefault(); goToAdmin(); }} className="admin-link">
              Admin Panel
            </a>
          )}
          
          <div className="akun-dropdown">
            <a href="#" onClick={e => { e.preventDefault(); toggleDropdown(); }}>
              {isLoggedIn ? `Halo, ${user?.username}` : 'Akun'}
            </a>
            {showDropdown && (
              <div className="dropdown-menu">
                {isLoggedIn ? (
                  // Jika sudah login, tampilkan admin panel (jika admin) dan logout
                  <>
                    {isAdmin() && (
                      <a href="#" onClick={e => { e.preventDefault(); goToAdmin(); }}>
                        Admin Panel
                      </a>
                    )}
                    <a href="#" onClick={e => { e.preventDefault(); handleLogout(); }}>Logout</a>
                  </>
                ) : (
                  // Jika belum login, tampilkan login dan register
                  <>
                    <a href="#" onClick={e => { e.preventDefault(); goToLogin(); }}>Login</a>
                    <a href="#" onClick={e => { e.preventDefault(); goToRegister(); }}>Register</a>
                  </>
                )}
              </div>
            )}
          </div>
        </nav>
      </header>
    
      {/* Halaman Beranda */}
      {currentPage === 'home' && (
        <>
          <section className="hero">
            <div className="hero-content">
              <h2>
                {isLoggedIn 
                  ? `Selamat datang kembali, ${user?.username}!` 
                  : 'Tugas Restoran Akhir Smt React JS'
                }
              </h2>
              <p>
                {isLoggedIn 
                  ? 'Nikmati pengalaman kuliner terbaik bersama kami' 
                  : 'DANCOKKKKKK'
                }
              </p>
              <button onClick={goToMenu}>Lihat Menu</button>
              
              {/* TAMBAHAN: Quick access untuk admin */}
              {isLoggedIn && isAdmin() && (
                <button onClick={goToAdmin} className="admin-quick-btn">
                  Akses Admin Panel
                </button>
              )}
            </div>
          </section>

          <section className="about">
            <h3>Tentang Kami</h3>
            <p>
              Restoran Lezat menyajikan berbagai hidangan khas nusantara dan internasional
              dengan bahan-bahan pilihan dan pelayanan terbaik.
            </p>
          </section>
        </>
      )}

      {/* Halaman Menu */}
      {currentPage === 'menu' && (
        <section className="menu">
          <h3>Daftar Menu</h3>
          
          {/* Loading State */}
          {loading && (
            <div className="loading">
              <p>Memuat menu...</p>
            </div>
          )}
          
          {/* Error State */}
          {error && (
            <div className="error">
              <p>{error}</p>
              <button onClick={fetchMenuItems}>Coba Lagi</button>
            </div>
          )}
          
          {/* Menu List */}
          {!loading && !error && (
            <div className="menu-list">
              {menuItems.length > 0 ? (
                menuItems.map((item) => (
                  <div className="menu-item" key={item.id_menu}>
                    {/* Gambar Menu */}
                    <div className="menu-image">
                      <img 
                        src={item.gambar || '/images/default-food.jpg'} 
                        alt={item.nama}
                        onError={(e) => {
                          e.target.src = '/images/default-food.jpg'; // Fallback image
                        }}
                      />
                    </div>
                    
                    {/* Detail Menu */}
                    <div className="menu-details">
                      <h4>{item.nama}</h4>
                      <p className="menu-price">{formatPrice(item.harga)}</p>
                      <p className="menu-stock">
                        Stok: <span className={item.stok > 0 ? 'in-stock' : 'out-of-stock'}>
                          {item.stok > 0 ? `${item.stok} tersedia` : 'Habis'}
                        </span>
                      </p>
                      
                      {/* Tombol Pesan */}
                      <button 
                        className={`order-btn ${item.stok === 0 ? 'disabled' : ''}`}
                        disabled={item.stok === 0}
                        onClick={() => {
                          if (isLoggedIn) {
                            // Redirect ke halaman pesanan dengan item terpilih
                            goToOrder();
                          } else {
                            alert('Silakan login terlebih dahulu untuk memesan');
                            goToLogin();
                          }
                        }}
                      >
                        {item.stok > 0 ? 'Pesan Sekarang' : 'Stok Habis'}
                      </button>
                    </div>
                  </div>
                ))
              ) : (
                <div className="no-menu">
                  <p>Belum ada menu tersedia.</p>
                </div>
              )}
            </div>
          )}
          
          {/* Refresh Button */}
          <div className="menu-actions">
            <button onClick={fetchMenuItems} disabled={loading}>
              {loading ? 'Memuat...' : 'Refresh Menu'}
            </button>
          </div>
        </section>
      )}

      {/* Halaman Kontak */}
      {currentPage === 'contact' && <Contact />}

      {/* Halaman Pesanan */}
      {currentPage === 'order' && <Order />}

      {/* Halaman Register */}
      {currentPage === 'register' && <Register />}

      {/* Halaman Login */}
      {currentPage === 'login' && <Login onLoginSuccess={handleLoginSuccess} />}

      {/* TAMBAHAN: Halaman Admin Dashboard */}
      {currentPage === 'admin' && (
        <>
          {isLoggedIn && isAdmin() ? (
            <AdminDashboard />
          ) : (
            <div className="admin-access-denied">
              <div className="access-denied-content">
                <h2>Akses Ditolak</h2>
                <p>Anda tidak memiliki akses ke halaman admin.</p>
                <button onClick={goToHome} className="back-home-btn">
                  Kembali ke Beranda
                </button>
              </div>
            </div>
          )}
        </>
      )}

      {/* Footer */}
      <footer className="footer">
        &copy; 2025 Restoran Lezat. All rights reserved.
      </footer>
    </div>
  );
}

export default App;