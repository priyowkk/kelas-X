import React from 'react';

function Sejarah() {
  return (
    <div className="page-container">
      <h1>Halaman Sejarah</h1>
      <p>Di sini Anda dapat membaca tentang sejarah perusahaan kami.</p>
      <div className="timeline">
        <div className="timeline-item">
          <h3>2010</h3>
          <p>Perusahaan didirikan.</p>
        </div>
        <div className="timeline-item">
          <h3>2015</h3>
          <p>Ekspansi ke pasar nasional.</p>
        </div>
        <div className="timeline-item">
          <h3>2020</h3>
          <p>Pengembangan platform digital.</p>
        </div>
      </div>
    </div>
  );
}

export default Sejarah;