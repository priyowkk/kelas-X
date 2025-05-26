import React, { useState } from 'react';

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Contact form submitted:', formData);
    alert('Pesan Anda telah terkirim!');
    setFormData({ name: '', email: '', message: '' });
  };

  return (
    <div className="contact-container">
      <div className="contact-content">
        <div className="contact-header">
          <h2>Hubungi Kami</h2>
          <p>Kami siap melayani Anda dengan sepenuh hati</p>
        </div>
        
        <div className="contact-grid">
          <div className="contact-info">
            <h3>Informasi Kontak</h3>
            
            <div className="info-item">
              <div className="info-icon">📍</div>
              <div className="info-text">
                <h4>Alamat</h4>
                <p>Jl. Raya Kuliner No. 123<br />Jakarta Selatan, 12345</p>
              </div>
            </div>
            
            <div className="info-item">
              <div className="info-icon">📞</div>
              <div className="info-text">
                <h4>Telepon</h4>
                <p>(021) 1234-5678</p>
              </div>
            </div>
            
            <div className="info-item">
              <div className="info-icon">✉️</div>
              <div className="info-text">
                <h4>Email</h4>
                <p>info@restoranlezat.com</p>
              </div>
            </div>
            
            <div className="info-item">
              <div className="info-icon">🕒</div>
              <div className="info-text">
                <h4>Jam Buka</h4>
                <p>Senin - Minggu<br />10:00 - 22:00 WIB</p>
              </div>
            </div>
          </div>
          
          <div className="contact-form">
            <h3>Kirim Pesan</h3>
            <form onSubmit={handleSubmit}>
              <div className="form-group">
                <label htmlFor="name">Nama Lengkap</label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  required
                />
              </div>
              
              <div className="form-group">
                <label htmlFor="email">Email</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                  required
                />
              </div>
              
              <div className="form-group">
                <label htmlFor="message">Pesan</label>
                <textarea
                  id="message"
                  name="message"
                  rows="5"
                  value={formData.message}
                  onChange={handleChange}
                  placeholder="Tulis pesan Anda di sini..."
                  required
                ></textarea>
              </div>
              
              <button type="submit" className="submit-btn">
                Kirim Pesan
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Contact;