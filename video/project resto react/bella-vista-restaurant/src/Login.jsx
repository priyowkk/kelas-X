import React, { useState } from 'react';

const Login = ({ onLoginSuccess }) => {
  const [loginData, setLoginData] = useState({
    username: '',
    password: ''
  });

  const [errors, setErrors] = useState({});
  const [isLoading, setIsLoading] = useState(false);

  const handleChange = (e) => {
    setLoginData({ ...loginData, [e.target.name]: e.target.value });
    // Clear error when user starts typing
    if (errors[e.target.name]) {
      setErrors({ ...errors, [e.target.name]: '' });
    }
  };

  const validateForm = () => {
    const newErrors = {};

    if (!loginData.username.trim()) {
      newErrors.username = 'Username harus diisi';
    }

    if (!loginData.password) {
      newErrors.password = 'Password harus diisi';
    }

    return newErrors;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const formErrors = validateForm();
    
    if (Object.keys(formErrors).length === 0) {
      setIsLoading(true);
      
      try {
        // Kirim data ke backend API
        const response = await fetch('http://localhost:3001/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            username: loginData.username,
            password: loginData.password
          }),
        });

        const result = await response.json();

        if (result.success) {
          // Simpan data user ke localStorage
          localStorage.setItem('user', JSON.stringify(result.user));
          alert('Login berhasil!');
          setLoginData({ username: '', password: '' });
          setErrors({});
          
          // Panggil callback untuk update state di App.jsx
          if (onLoginSuccess) {
            onLoginSuccess(result.user);
          }
        } else {
          // Tampilkan error dari server
          alert(`Error: ${result.message}`);
        }
      } catch (error) {
        console.error('Error during login:', error);
        alert('Terjadi kesalahan koneksi. Pastikan server backend berjalan.');
      } finally {
        setIsLoading(false);
      }
    } else {
      setErrors(formErrors);
    }
  };

  return (
    <div className="login-container">
      <div className="login-content">
        <div className="login-header">
          <h2>Masuk ke Akun</h2>
          <p>Selamat datang kembali di Restoran Lezat</p>
        </div>
        
        <div className="login-form">
          <form onSubmit={handleSubmit}>
            <div className="login-form-group">
              <label htmlFor="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                value={loginData.username}
                onChange={handleChange}
                placeholder="Masukkan username Anda"
                className={errors.username ? 'error' : ''}
                disabled={isLoading}
              />
              {errors.username && <span className="error-message">{errors.username}</span>}
            </div>
            
            <div className="login-form-group">
              <label htmlFor="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                value={loginData.password}
                onChange={handleChange}
                placeholder="Masukkan password Anda"
                className={errors.password ? 'error' : ''}
                disabled={isLoading}
              />
              {errors.password && <span className="error-message">{errors.password}</span>}
            </div>
            
            <button type="submit" className="login-submit-btn" disabled={isLoading}>
              {isLoading ? 'Masuk...' : 'Masuk'}
            </button>
          </form>
          
          <div className="login-footer">
            <p>Belum punya akun? <a href="#" className="register-link">Daftar di sini</a></p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;