const express = require('express');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();

// Konfigurasi database - PINDAHKAN KE ATAS
const dbConfig = {
  host: '127.0.0.1',
  user: 'root', // Ganti dengan username MySQL Anda
  password: '', // Ganti dengan password MySQL Anda jika ada
  database: 'restoran_lezat'
};

// Middleware - URUTAN PENTING
app.use(cors({
  origin: ['http://localhost:3000', 'http://127.0.0.1:3000', 'http://localhost:5173'],
  credentials: true
}));
app.use(express.json());

// Serve static files for admin interface
app.use(express.static('public'));

// Test endpoint
app.get('/', (req, res) => {
  res.json({ message: 'Server backend berjalan dengan baik!' });
});

// Test database connection
app.get('/test-db', async (req, res) => {
  try {
    const connection = await mysql.createConnection(dbConfig);
    await connection.execute('SELECT 1');
    await connection.end();
    res.json({ success: true, message: 'Koneksi database berhasil!' });
  } catch (error) {
    console.error('Database connection error:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Koneksi database gagal', 
      error: error.message 
    });
  }
});

// Test endpoint untuk cek koneksi database
app.get('/api/test-db', async (req, res) => {
  try {
    const connection = await mysql.createConnection(dbConfig);
    const [rows] = await connection.execute('SELECT COUNT(*) as total FROM users');
    await connection.end();
    
    res.json({ 
      success: true, 
      message: 'Koneksi database berhasil',
      totalUsers: rows[0].total 
    });
  } catch (error) {
    console.error('Database connection error:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Koneksi database gagal',
      error: error.message 
    });
  }
});

// Endpoint untuk mengambil daftar menu - DIPERBAIKI
app.get('/api/menu', async (req, res) => {
  console.log('Fetching menu items...');
  
  try {
    const connection = await mysql.createConnection(dbConfig);
    console.log('Database connected for menu fetch');
    
    // Query sesuai dengan struktur tabel yang Anda berikan
    const [rows] = await connection.execute(
      'SELECT id_menu, gambar, nama, harga, stok, created_at, updated_at FROM menu ORDER BY id_menu ASC'
    );
    
    await connection.end();
    console.log('Menu items fetched:', rows.length, 'items');
    
    // Set headers untuk memastikan response JSON
    res.setHeader('Content-Type', 'application/json');
    res.json({
      success: true,
      data: rows,
      count: rows.length
    });
    
  } catch (error) {
    console.error('Error fetching menu items:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Gagal mengambil data menu', 
      error: error.message,
      details: error.stack
    });
  }
});

// Endpoint untuk registrasi - TANPA ENKRIPSI PASSWORD
app.post('/api/register', async (req, res) => {
  console.log('Received registration request:', req.body);
  
  try {
    const { username, password } = req.body;
    
    // Validasi input
    if (!username || !password) {
      return res.status(400).json({ 
        success: false, 
        message: 'Username dan password harus diisi' 
      });
    }
    
    if (username.length < 3) {
      return res.status(400).json({ 
        success: false, 
        message: 'Username minimal 3 karakter' 
      });
    }
    
    if (password.length < 6) {
      return res.status(400).json({ 
        success: false, 
        message: 'Password minimal 6 karakter' 
      });
    }
    
    console.log('Connecting to database...');
    const connection = await mysql.createConnection(dbConfig);
    
    // Cek apakah username sudah ada
    console.log('Checking if username exists...');
    const [existingUsers] = await connection.execute(
      'SELECT COUNT(*) as count FROM users WHERE username = ?',
      [username]
    );
    
    if (existingUsers[0].count > 0) {
      await connection.end();
      return res.status(400).json({ 
        success: false, 
        message: 'Username sudah digunakan' 
      });
    }
    
    // Simpan user baru dengan password plain text
    console.log('Inserting new user...');
    const [result] = await connection.execute(
      'INSERT INTO users (username, password) VALUES (?, ?)',
      [username, password] // Password disimpan tanpa enkripsi
    );
    
    await connection.end();
    
    console.log('User registered successfully with ID:', result.insertId);
    
    res.status(201).json({ 
      success: true, 
      message: 'Registrasi berhasil',
      userId: result.insertId 
    });
    
  } catch (error) {
    console.error('Error during registration:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Terjadi kesalahan server',
      error: error.message 
    });
  }
});

// Endpoint untuk login - TANPA VERIFIKASI ENKRIPSI
app.post('/api/login', async (req, res) => {
  try {
    const { username, password } = req.body;
    
    if (!username || !password) {
      return res.status(400).json({ 
        success: false, 
        message: 'Username dan password harus diisi' 
      });
    }
    
    const connection = await mysql.createConnection(dbConfig);
    
    // Ambil data user dan bandingkan password langsung
    const [users] = await connection.execute(
      'SELECT id, username, password FROM users WHERE username = ? AND password = ? AND is_active = TRUE',
      [username, password] // Bandingkan password langsung tanpa enkripsi
    );
    
    await connection.end();
    
    if (users.length === 0) {
      return res.status(401).json({ 
        success: false, 
        message: 'Username atau password salah' 
      });
    }
    
    res.json({ 
      success: true, 
      message: 'Login berhasil',
      user: {
        id: users[0].id,
        username: users[0].username
      }
    });
    
  } catch (error) {
    console.error('Error during login:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Terjadi kesalahan server' 
    });
  }
});

// Admin endpoint to get all users
app.get('/api/admin/users', async (req, res) => {
  console.log('Fetching all users for admin...');
  
  try {
    const connection = await mysql.createConnection(dbConfig);
    console.log('Database connected for admin users fetch');
    
    const [rows] = await connection.execute(
      'SELECT id, username, is_active, created_at FROM users ORDER BY id ASC'
    );
    
    await connection.end();
    console.log('Users fetched:', rows.length, 'users');
    
    res.setHeader('Content-Type', 'application/json');
    res.json({
      success: true,
      data: rows,
      count: rows.length
    });
    
  } catch (error) {
    console.error('Error fetching users:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Gagal mengambil data pengguna', 
      error: error.message,
      details: error.stack
    });
  }
});

// Admin endpoint to toggle user active status
app.put('/api/admin/users/:id/toggle-active', async (req, res) => {
  console.log('Toggling user active status...');
  
  try {
    const { id } = req.params;
    
    const connection = await mysql.createConnection(dbConfig);
    
    // Check if user exists
    const [user] = await connection.execute(
      'SELECT is_active FROM users WHERE id = ?',
      [id]
    );
    
    if (user.length === 0) {
      await connection.end();
      return res.status(404).json({ 
        success: false, 
        message: 'Pengguna tidak ditemukan' 
      });
    }
    
    const newStatus = user[0].is_active ? 0 : 1;
    
    await connection.execute(
      'UPDATE users SET is_active = ? WHERE id = ?',
      [newStatus, id]
    );
    
    await connection.end();
    console.log(`User ID ${id} status updated to ${newStatus}`);
    
    res.json({ 
      success: true, 
      message: `Status pengguna berhasil diubah ke ${newStatus ? 'Aktif' : 'Nonaktif'}`,
      is_active: newStatus 
    });
    
  } catch (error) {
    console.error('Error toggling user status:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Gagal mengubah status pengguna', 
      error: error.message,
      details: error.stack
    });
  }
});

const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`Server berjalan di port ${PORT}`);
  console.log(`Test server: http://localhost:${PORT}`);
  console.log(`Test database: http://localhost:${PORT}/test-db`);
  console.log(`Test menu API: http://localhost:${PORT}/api/menu`);
  console.log(`Test admin users API: http://localhost:${PORT}/api/admin/users`);
});