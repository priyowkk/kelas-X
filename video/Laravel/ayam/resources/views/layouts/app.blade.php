<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Delights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FFD700; /* Yellow */
            --secondary-color: #212121; /* Black */
            --accent-color: #FFA000; /* Darker Yellow */
            --text-light: #FFF;
            --text-dark: #000;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .bg-primary-custom {
            background-color: var(--primary-color);
        }
        
        .bg-secondary-custom {
            background-color: var(--secondary-color);
        }
        
        .text-primary-custom {
            color: var(--primary-color);
        }
        
        .text-secondary-custom {
            color: var(--secondary-color);
        }
        
        .btn-primary-custom {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }
        
        /* Navbar styles */
        .navbar {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
        }
        
        .navbar .nav-link:hover {
            color: var(--accent-color) !important;
        }
        
        .logo {
            height: 70px;
        }
        
        /* Product card styles */
        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-img {
            height: 200px;
            object-fit: cover;
        }
        
        /* Footer styles */
        footer {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 2rem 0;
        }
        
        /* Banner styles */
        .banner {
            height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: var(--text-light);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        /* Cart styles */
        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Chicken Delights" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="badge bg-primary-custom text-secondary-custom">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Chicken Delights</h4>
                    <p>Serving the best fried chicken in town since 2020.</p>
                </div>
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p>Email: info@chickendelights.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
                <div class="col-md-4">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2025 Chicken Delights. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>