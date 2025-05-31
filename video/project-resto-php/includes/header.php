<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/project-resto-php/css/style.css" rel="stylesheet">
</head>
<style>
    .navbar-brand i {
    font-size: 1.5rem;
}

.nav-link {
    position: relative;
    transition: color 0.3s ease;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    background-color: #ffc107; /* warna kuning/coklat terang */
    bottom: 0;
    left: 0;
    transition: width 0.3s ease-in-out;
}

.nav-link:hover::after {
    width: 100%;
}

.navbar-dark .navbar-nav .nav-link.active,
.navbar-dark .navbar-nav .nav-link:hover {
    color: #ffc107; /* warna kuning/coklat terang */
}

</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/project-resto-php/">
            <i class="fas fa-utensils me-2 text-warning"></i>
            <strong class="text-white">RestoPHP</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/project-resto-php/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/project-resto-php/menu.php">Menu</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/project-resto-php/order.php">My Orders</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">                    <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/project-resto-php/admin/admin.php">
                                <i class="fas fa-user-shield me-1"></i> Admin
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/project-resto-php/logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/project-resto-php/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/project-resto-php/register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    <div class="content-wrapper">
