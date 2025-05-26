import React, { useState } from 'react';

const Register = () => {
  const [registerData, setRegisterData] = useState({
    username: '',
    password: '',
    confirmPassword: ''
  });

  const [errors, setErrors] = useState({});
  const [isLoading, setIsLoading] = useState(false);
  const [successMessage, setSuccessMessage] = useState('');

  const handleChange = (e) => {
    setRegisterData({ ...registerData, [e.target.name]: e.target.value });
    // Clear error when user starts typing
    if (errors[e.target.name]) {
      setErrors({ ...errors, [e.target.name]: '' });
    }
    // Clear success message when user starts typing
    if (successMessage) {
      setSuccessMessage('');
    }
  };

  const validateForm = () => {
    const newErrors = {};

    if (!registerData.username.trim()) {
      newErrors.username = 'Username harus diisi';
    } else if (registerData.username.length < 3) {
      newErrors.username = 'Username minimal 3 karakter';
    }

    if (!registerData.password) {
      newErrors.password = 'Password harus diisi';
    } else if (registerData.password.length < 6) {
      newErrors.password = 'Password minimal 6 karakter';
    }

    if (!registerData.confirmPassword) {
      newErrors.confirmPassword = 'Konfirmasi password harus diisi';
    } else if (registerData.password !== registerData.confirmPassword) {
      newErrors.confirmPassword = 'Password tidak cocok';
    }

    return newErrors;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const formErrors = validateForm();
    
    if (Object.keys(formErrors).length === 0) {
      setIsLoading(true);
      setErrors({});
      
      try {
        // Simulasi API call (karena tidak ada backend yang berjalan)
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Simulasi response sukses
        const mockResponse = { success: true };
        
        if (mockResponse.success) {
          setSuccessMessage('Pendaftaran berhasil! Data telah disimpan.');
          setRegisterData({ username: '', password: '', confirmPassword: '' });
          setErrors({});
        }

        const response = await fetch('http://localhost:3001/api/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            username: registerData.username,
            password: registerData.password
          }),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();

        if (result.success) {
          setSuccessMessage('Pendaftaran berhasil! Data telah disimpan ke database.');
          setRegisterData({ username: '', password: '', confirmPassword: '' });
          setErrors({});
        } else {
          if (result.message && result.message.includes('Username sudah digunakan')) {
            setErrors({ username: result.message });
          } else {
            setErrors({ general: result.message || 'Terjadi kesalahan' });
          }
        }
        
      } catch (error) {
        console.error('Error during registration:', error);
        setErrors({ 
          general: 'Terjadi kesalahan koneksi. Pastikan server backend berjalan di http://localhost:3001' 
        });
      } finally {
        setIsLoading(false);
      }
    } else {
      setErrors(formErrors);
    }
  };

  return (
    <div className="register-container">
      <div className="register-content">
        <div className="register-header">
          <h2>Daftar Akun Baru</h2>
          <p>Bergabunglah dengan Restoran Lezat untuk pengalaman yang lebih baik</p>
        </div>
        
        {successMessage && (
          <div className="success-message">
            {successMessage}
          </div>
        )}

        {errors.general && (
          <div className="general-error">
            {errors.general}
          </div>
        )}
        
        <div className="register-form">
          <div className="register-form-group">
            <label htmlFor="username">Username</label>
            <input
              type="text"
              id="username"
              name="username"
              value={registerData.username}
              onChange={handleChange}
              placeholder="Masukkan username Anda"
              disabled={isLoading}
              className={errors.username ? 'error' : ''}
            />
            {errors.username && (
              <span className="error-message">{errors.username}</span>
            )}
          </div>
          
          <div className="register-form-group">
            <label htmlFor="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              value={registerData.password}
              onChange={handleChange}
              placeholder="Masukkan password Anda"
              disabled={isLoading}
              className={errors.password ? 'error' : ''}
            />
            {errors.password && (
              <span className="error-message">{errors.password}</span>
            )}
          </div>
          
          <div className="register-form-group">
            <label htmlFor="confirmPassword">Konfirmasi Password</label>
            <input
              type="password"
              id="confirmPassword"
              name="confirmPassword"
              value={registerData.confirmPassword}
              onChange={handleChange}
              placeholder="Ulangi password Anda"
              disabled={isLoading}
              className={errors.confirmPassword ? 'error' : ''}
            />
            {errors.confirmPassword && (
              <span className="error-message">{errors.confirmPassword}</span>
            )}
          </div>
          
          <button 
            type="submit" 
            disabled={isLoading}
            onClick={handleSubmit}
            className="register-submit-btn"
          >
            {isLoading ? 'Mendaftar...' : 'Daftar Sekarang'}
          </button>
        </div>
        
        <div className="register-footer">
          <p>
            Sudah punya akun?{' '}
            <a href="Login" className="login-link">
              Login di sini
            </a>
          </p>
        </div>
      </div>
    </div>
  );
};

export default Register;