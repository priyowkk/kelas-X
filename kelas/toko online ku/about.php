<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
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

        .nav-link {
            position: relative;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
            visibility: hidden;
            /* Tambahkan ini */
        }

        .nav-link:hover::after {
            width: 100%;
            visibility: visible;
            /* Tambahkan ini */
        }

        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            background: linear-gradient(135deg, #2c3e50, #3498db);
        }

        .dropdown-item {
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
            color: #ffffff;
        }


        .search-box {
            position: relative;
        }

        .search-box input {
            border-radius: 25px;
            padding-right: 40px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 20px;
        }

        .search-box .bi-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
        }

        /* Custom styles for the modal */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-header .btn-close {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            font-size: 1.2rem;
        }

        .modal-header .btn-close:hover {
            background-color: #3498db;
            color: white;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #ccc;
            color: white;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }


        /* Back Button Styles */
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .back-button svg {
            width: 24px;
            height: 24px;
            fill: #2c3e50;
        }

        /* About Page Styles */
        .about-hero {
            background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(52, 152, 219, 0.7)), url('images/comunity.webp');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        .stats-section {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 60px 0;
            margin: 50px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="produkDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="produkDropdown">
                                <li><a class="dropdown-item" href="produk/pod_kategori.php">POD</a></li>
                                <li><a class="dropdown-item" href="produk/liquid_kategori.php">Liquid</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="kontak.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    </ul>

                    <!-- Search and Buttons -->
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                            <input type="text" class="form-control" style="width: 200px;" placeholder="Cari...">
                            <i class="bi bi-search"></i>
                        </div>
                        <!-- Tombol Register -->
                        <a class="btn btn-outline-light me-2" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>

                        <!-- Tombol Login -->
                        <a class="btn btn-outline-light" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>



    <!-- Back Button -->
    <a href="index.php" class="back-button" title="Kembali ke Beranda">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .77-1.64L7.14 13H19a1 1 0 0 0 0-2z" />
        </svg>
    </a>

    <!-- Hero Section -->
    <div class="about-hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Vape Store</h1>
            <p class="lead">Destinasi Utama untuk Pengalaman Vaping Premium</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Story Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mb-4">Cerita Kami</h2>
                <p class="lead">Didirikan pada tahun 2020, Vape Store hadir sebagai solusi bagi para vaper yang menginginkan produk berkualitas dengan pelayanan terpercaya. Kami berkomitmen untuk menyediakan produk vape terbaik dengan harga yang kompetitif.</p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h4>Produk Asli</h4>
                    <p>Kami hanya menjual produk original dengan garansi resmi dari distributor terpercaya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-people feature-icon"></i>
                    <h4>Konsultasi Ahli</h4>
                    <p>Tim kami siap membantu Anda memilih produk yang sesuai dengan kebutuhan vaping Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-truck feature-icon"></i>
                    <h4>Pengiriman Cepat</h4>
                    <p>Layanan pengiriman cepat ke seluruh Indonesia dengan packaging yang aman.</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">5000+</div>
                            <div>Pelanggan Puas</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">200+</div>
                            <div>Produk Tersedia</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">50+</div>
                            <div>Merek Partner</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-number">3</div>
                            <div>Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision Mission Section -->
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="feature-card">
                    <h3>Visi</h3>
                    <p>Menjadi destinasi utama dan terpercaya bagi komunitas vaping di Indonesia dengan menyediakan produk berkualitas dan layanan premium.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-card">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan produk vape berkualitas dengan harga terbaik</li>
                        <li>Memberikan edukasi dan panduan penggunaan yang aman</li>
                        <li>Membangun komunitas vaping yang positif dan bertanggung jawab</li>
                        <li>Mengutamakan kepuasan pelanggan dalam setiap layanan</li>
                    </ul>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #2c3e50, #3498db);">
                    <h5 class="modal-title text-white" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #3498db, #2c3e50);">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #2c3e50, #3498db);">
                    <h5 class="modal-title text-white" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="registerConfirmPassword" placeholder="Confirm your password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #3498db, #2c3e50);">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>