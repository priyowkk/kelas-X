<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Toko Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="website icon" type="png" href="images/vaporesso.png">

    <style>
        body,
        html {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            scroll-behavior: smooth;
        }

        header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 150px;
            margin-right: 40px;
        }

        /* Cart Styling */
        .cart-item {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }

        .cart-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .cart-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .cart-item .card-body {
            padding: 1rem;
        }

        .cart-item .card-body h5 {
            font-size: 1.2rem;
        }

        .cart-item .card-body p {
            color: #3498db;
        }

        .cart-total {
            background-color: #3498db;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-total h5 {
            font-weight: 600;
        }

        footer {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h5 {
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section li {
            margin-bottom: 0.8rem;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
        }

        .social-icons {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: white;
            color: #2c3e50;
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .footer-section h5 {
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }

            .footer-section ul li {
                font-size: 0.9rem;
            }

            .social-icons a {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .footer-section {
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }

            .copyright {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="text-white py-3">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- Brand -->
                <div class="logo">
                    <img src="images/logo-removebg-preview.png" alt="">
                </div>

                <!-- Navbar Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Cart Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Cart Item 1 -->
                <div class="cart-item mb-4">
                    <div class="row g-3">
                        <div class="col-4">
                            <img src="images/XROS4.webp" class="img-fluid" alt="Produk 1">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Xros 4</h5>
                                <p class="card-text">Rp 349.999</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="number" class="form-control w-25" value="1">
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="cart-item mb-4">
                    <div class="row g-3">
                        <div class="col-4">
                            <img src="images/kit-gen-max-vaporesso .jpg" class="img-fluid" alt="Produk 2">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">Gen Max</h5>
                                <p class="card-text">Rp 549.999</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="number" class="form-control w-25" value="1">
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-total">
                    <h5>Total Belanja</h5>
                    <p class="mb-3">Rp 899.998</p>
                    <button class="btn btn-light w-100">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>Tentang Kami</h5>
                    <p>Toko Online terpercaya dengan produk berkualitas dan pelayanan terbaik untuk kepuasan pelanggan.</p>
                    <div class="social-icons">
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#">Cara Pembelian</a></li>
                        <li><a href="#">Pengiriman</a></li>
                        <li><a href="#">Pembayaran</a></li>
                        <li><a href="#">Pengembalian</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Informasi</h5>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Kontak</h5>
                    <ul>
                        <li><i class="bi bi-geo-alt-fill me-2"></i>Jl. Contoh No. 123</li>
                        <li><i class="bi bi-telephone-fill me-2"></i>(021) 1234-5678</li>
                        <li><i class="bi bi-envelope-fill me-2"></i>info@tokoonline.com</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Toko Online. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>