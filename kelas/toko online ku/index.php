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
            /* height: 100px; */
            margin-right: 40px;
        }

        /* Dropdown menu styling */
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
            /* Menambahkan padding kiri agar tidak terlalu mepet dengan teks */
        }

        .search-box .bi-search {
            position: absolute;
            right: 10px;
            /* Menempatkan ikon pada sisi kanan */
            top: 50%;
            transform: translateY(-50%);
            /* Menyelaraskan ikon secara vertikal */
            color: white;
        }

        #carouselBanner {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        #carouselBanner .carousel-item {
            height: 450px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 450px;
            transition: transform 0.5s ease-in-out, opacity 0.3s ease-in-out;
            animation: slide-animation 1.5s ease-in-out;
        }


        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        .carousel-item:hover {
            transform: scale(1.05);
            background-color: rgba(0, 0, 0, 0.5);
        }


        .static-banner {
            background-image: url('images/luxe.jpg');
            border-radius: 15px;
            padding: 2.5rem;
            height: 100%;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            /* background-repeat: no-repeat; */
            background-size: cover;
            background-position: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .static-banner:hover {
            transform: scale(1.05);
            background-color: rgba(0, 0, 0, 0.5);
        }


        .static-banner h2 {
            color: black;
        }


        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .card img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body button {
            margin-top: 5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

        /* Menambahkan efek blur pada body saat modal aktif */
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
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="produkDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="produkDropdown">
                                <li><a class="dropdown-item" href="produk/pod_kategori.php">POD</a></li>
                                <li><a class="dropdown-item" href="produk/liquid_kategori.php">Liquid</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="kontak.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    </ul>
                    <!-- Search and Buttons -->
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                            <input type="text" class="form-control" style="width: 200px;" placeholder="Cari...">
                            <i class="bi bi-search"></i>
                        </div>
                        <!-- Ubah tombol Register dan Login di bagian header -->
                        <a class="btn btn-outline-light me-2" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                        <a class="btn btn-outline-light" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>

                    </div>
                </div>
            </div>
        </nav>
    </header>


    <!-- Banner Section -->
    <div class="container my-4">
        <div class="row g-4">
            <div class="col-md-8">
                <div id="carouselBanner" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="images/banner1.webp" class="d-block w-100" alt="Mangga">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Vaporesso Xros Pro</h5>
                                <p>Kualitas tinggi</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/banner2.webp" class="d-block w-100" alt="Background">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Vaporesso Vibe Nano</h5>
                                <p>Dapatkan diskon menarik</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/bannerrrr.webp" class="d-block w-100" alt="Jagung Rebus">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Vaporesso Xros 4 Nano</h5>
                                <p>manis dan segar</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="static-banner">
                    <a href=""></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container my-5" id="produk">
        <h2 class="text-center mb-4">Produk Unggulan</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <img src="images/XROS4.webp" class="card-img-top" alt="Alpukat">
                    <div class="card-body">
                        <h5 class="card-title">Xros 4</h5>
                        <p class="card-text">Rp 349.999</p>
                        <button class="btn btn-primary w-100">Beli Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <img src="images/nano4.webp" class="card-img-top" alt="Burger">
                    <div class="card-body">
                        <h5 class="card-title">Xros Nano 4</h5>
                        <p class="card-text">Rp 349.999 </p>
                        <button class="btn btn-primary w-100">Beli Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <img src="images/strawberry.jpg" class="card-img-top" alt="Es">
                    <div class="card-body">
                        <h5 class="card-title">Strawberry Cheesecake</h5>
                        <p class="card-text">Rp 135.000</p>
                        <button class="btn btn-primary w-100">Beli Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <img src="images/od.jpg" class="card-img-top" alt="Jagung Bakar">
                    <div class="card-body">
                        <h5 class="card-title">Oat Drips</h5>
                        <p class="card-text">Rp 120.000</p>
                        <button class="btn btn-primary w-100">Beli Sekarang</button>
                    </div>
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
                <p>&copy; Priyo Anggodho/X-RPL/30.</p>
            </div>
        </div>
    </footer>
    <!-- Modal Register -->
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


<!-- Modal Login -->
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



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menutup modal dan menghapus blur saat modal ditutup
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));

        // Tidak perlu menambahkan script tambahan karena Bootstrap sudah menangani modal
    </script>

</body>

</html>