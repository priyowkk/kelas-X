<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="website icon" type="png" href="images/vaporesso.png">
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding-top: 70px;
            /* Menambahkan ruang untuk navbar */
        }

        header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 150px;
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
        }

        .nav-link:hover::after {
            width: 100%;
            visibility: visible;
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

        .feedback-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Styling input fields */
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #007BFF;
        }

        textarea {
            resize: vertical;
        }

        /* Rating Stars */
        .stars {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .stars input:checked~label,
        .stars input:hover~label,
        .stars label:hover {
            color: #FFD700;
        }

        .stars input:checked+label {
            color: #FFD700;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="produkDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="produkDropdown">
                                <li><a class="dropdown-item" href="produk/pod_kategori.php">POD</a></li>
                                <li><a class="dropdown-item" href="produk/liquid_kategori.php">Liquid</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" href="kontak.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    </ul>
                    <!-- Search and Buttons -->
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                            <input type="text" class="form-control" style="width: 200px;" placeholder="Cari...">
                            <i class="bi bi-search"></i>
                        </div>
                        <!-- Tombol Register -->

                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="feedback-container">
        <h2>Berikan Umpan Balik Anda</h2>
        <form action="#" method="POST">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>

            <label for="feedback">Umpan Balik:</label>
            <textarea id="feedback" name="feedback" rows="4" placeholder="Berikan umpan balik Anda..." required></textarea>

            <div class="rating">
                <label for="rating">Rating:</label>
                <div class="stars">
                    <input type="radio" name="rating" id="star5" value="5">
                    <label for="star5">&#9733;</label>
                    <input type="radio" name="rating" id="star4" value="4">
                    <label for="star4">&#9733;</label>
                    <input type="radio" name="rating" id="star3" value="3">
                    <label for="star3">&#9733;</label>
                    <input type="radio" name="rating" id="star2" value="2">
                    <label for="star2">&#9733;</label>
                    <input type="radio" name="rating" id="star1" value="1">
                    <label for="star1">&#9733;</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Kirim Feedback</button>
        </form>
    </div>
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>