import React, { useState } from 'react';

const Order = () => {
  const [orderData, setOrderData] = useState({
    name: '',
    address: '',
    phone: '',
    items: '',
    notes: ''
  });

  const handleChange = (e) => {
    setOrderData({ ...orderData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Simulasi pengiriman pesanan (bisa diganti dengan API call)
    console.log('Order submitted:', orderData);
    alert('Pesanan telah diterima!');
    setOrderData({ name: '', address: '', phone: '', items: '', notes: '' });
  };

  return (
    <div className="order-container">
      <div className="order-content">
        <div className="order-header">
          <h2>Pesan Makanan</h2>
          <p>Isi detail pesanan Anda di bawah ini</p>
        </div>
        
        <div className="order-form">
          <form onSubmit={handleSubmit}>
            <div className="order-form-group">
              <label htmlFor="name">Nama Lengkap</label>
              <input
                id="name"
                name="name"
                type="text"
                value={orderData.name}
                onChange={handleChange}
                required
              />
            </div>
            
            <div className="order-form-group">
              <label htmlFor="address">Alamat Pengiriman</label>
              <input
                id="address"
                name="address"
                type="text"
                value={orderData.address}
                onChange={handleChange}
                required
              />
            </div>
            
            <div className="order-form-group">
              <label htmlFor="phone">Nomor Telepon</label>
              <input
                id="phone"
                name="phone"
                type="tel"
                value={orderData.phone}
                onChange={handleChange}
                required
              />
            </div>
            
            <div className="order-form-group">
              <label htmlFor="items">Detail Pesanan</label>
              <textarea
                id="items"
                name="items"
                rows="4"
                value={orderData.items}
                onChange={handleChange}
                placeholder="Contoh: 2 Nasi Goreng Spesial, 1 Ayam Bakar, 2 Es Teh Manis"
                required
              ></textarea>
            </div>
            
            <div className="order-form-group">
              <label htmlFor="notes">Catatan Tambahan</label>
              <textarea
                id="notes"
                name="notes"
                rows="3"
                value={orderData.notes}
                onChange={handleChange}
                placeholder="Contoh: Tambah pedas, tanpa bawang"
              ></textarea>
            </div>
            
            <button type="submit" className="order-submit-btn">
              Kirim Pesanan
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Order;