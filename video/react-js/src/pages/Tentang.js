import React, { useState } from 'react';

function Tentang() {
  const [counter, setCounter] = useState(0);

  const handleIncrement = () => {
    const newValue = counter + 1;
    setCounter(newValue);
    alert(newValue);
  };

  const handleDecrement = () => {
    const newValue = counter - 1;
    setCounter(newValue);
    alert(newValue);
  };

  return (
    <div className="page-container">
      <h1>Halaman Tentang</h1>
      <p>Informasi tentang perusahaan kami.</p>
      <div className="about-content">
        <h3>Visi</h3>
        <p>Menjadi perusahaan terkemuka dalam bidang teknologi di Indonesia.</p>
        
        <h3>Misi</h3>
        <p>Menyediakan solusi teknologi yang inovatif dan berkualitas tinggi untuk memenuhi kebutuhan pelanggan.</p>
        
        <h3>Nilai-Nilai</h3>
        <ul>
          <li>Integritas</li>
          <li>Inovasi</li>
          <li>Kolaborasi</li>
          <li>Kepuasan Pelanggan</li>
        </ul>

        <div style={{ marginTop: '20px' }}>
          <button 
            onClick={handleIncrement} 
            style={{ 
              backgroundColor: 'blue', 
              color: 'white', 
              padding: '8px 16px', 
              marginRight: '10px',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Tambah
          </button>
          <button 
            onClick={handleDecrement} 
            style={{ 
              backgroundColor: 'green', 
              color: 'white', 
              padding: '8px 16px',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Kurang
          </button>
        </div>
      </div>
    </div>
  );
}

export default Tentang;