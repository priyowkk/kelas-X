<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POD Products - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="website icon" type="png" href="../images/vaporesso.png">
    <style>
        body,
        html {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
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
            z-index: 1050;
            /* Tingkatkan z-index */
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


        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(52, 152, 219, 0.1);
            position: relative;
            z-index: 1;
            overflow: auto;
            margin-top: -70px;
            /* Mengangkat filter ke atas */
        }


        .filter-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group h6 {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .form-check-label {
            color: #566573;
            transition: color 0.3s ease;
        }

        .form-check-input:checked+.form-check-label {
            color: #3498db;
            font-weight: 500;
        }

        .row.g-4 {
            margin-top: 10px;
            /* Atur nilai sesuai kebutuhan */
        }


        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            background: white;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(44, 62, 80, 0.15);
        }

        .card-img-wrapper {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa, #ebf0f6);
        }

        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .price {
            color: #3498db;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .badge-stock {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(44, 62, 80, 0.85);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .product-rating {
            color: #f1c40f;
            margin-bottom: 0.5rem;
        }

        .product-specs {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 1rem;
        }

        .product-specs i {
            color: #3498db;
            margin-right: 0.5rem;
        }
    </style>
</head>

<body>
    <header class="text-white py-3">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- Brand -->
                <div class="logo">
                    <img src="../images/logo-removebg-preview.png" alt="">
                </div>


                <!-- Navbar Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="produkDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="produkDropdown">
                                <li><a class="dropdown-item" href="../produk/pod_kategori.php">POD</a></li>
                                <li><a class="dropdown-item active" href="../produk/liquid_kategori.php">Liquid</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../kontak.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="../cart.php">Cart</a></li>
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

    <!-- Main Content -->
    <div class="container">
        <div class="row g-4">
            <!-- Enhanced Filter Sidebar -->
            <div class="col-lg-3">
                <div class="filter-section sticky-top" style="top: 100px;">
                    <h4 class="filter-title">Filters</h4>

                    <div class="filter-group">
                        <h6>Flavour</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="vaporesso">
                            <label class="form-check-label" for="vaporesso">Creamy</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="voopoo">
                            <label class="form-check-label" for="voopoo">Menthol</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="smok">
                            <label class="form-check-label" for="smok">Fruity</label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <h6>Price Range</h6>
                        <input type="range" class="form-range" min="50000" max="200000" id="priceRange">
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted">Rp 50.000</span>
                            <span class="text-muted">Rp 200.000</span>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Enhanced Products Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    <!-- Product Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-img-wrapper">
                                <img src="../images/oat drips.jpg" class="card-img-top" alt="Xros 4">
                                <span class="badge-stock">In Stock</span>
                            </div>
                            <div class="card-body">
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <span class="ms-2 text-muted">(4.5)</span>
                                </div>
                                <h5 class="card-title">Oat Drips</h5>
                                <div class="product-specs">

                                    <p><i class="bi bi-droplet-fill"></i>30ml</p>
                                    <p><i class="bi"></i>30mg Nic</p>
                                </div>
                                <div class="price mb-3">Rp 120.000</div>
                                <button class="btn btn-primary w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-img-wrapper">
                                <img src="../images/eb.jpg" class="card-img-top" alt="Gen Max">
                                <span class="badge-stock">In Stock</span>
                            </div>
                            <div class="card-body">
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <span class="ms-2 text-muted">(5.0)</span>
                                </div>
                                <h5 class="card-title">English Breakfast Yogurt</h5>
                                <div class="product-specs">

                                    <p><i class="bi bi-droplet-fill"></i>60ml</p>
                                    <p><i class="bi "></i>30mg Nic</p>
                                </div>
                                <div class="price mb-3">Rp 149.000</div>
                                <button class="btn btn-primary w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Add more product cards as needed -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer stays the same -->
    <footer>
        <!-- Same footer as original -->
    </footer>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>