<?php
session_start();
include 'includes/db.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if ($username) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Fetch latest routes
$routes_query = "SELECT * FROM routes ORDER BY id DESC LIMIT 6";
$routes_result = $conn->query($routes_query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Ticket Booking System</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Popup Login -->
    <div class="overlay" id="overlay"></div>
    <div class="login-popup" id="loginPopup">
        <h3>Login Required</h3>
        <p>You need to login first to book tickets.</p>
        <div class="popup-buttons">
            <button class="login-btn" onclick="goToLogin()">Login</button>
            <button class="cancel-btn" onclick="closePopup()">Cancel</button>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">
            <!-- <i class="fas fa-train"></i> -->
            <img src="image/new_logo-removebg-preview.png" alt="" href="index.php">
        </div>
        <div class="nav-links">
            <a href="#nav">Home</a>
            <a href="#cont">Contact Us</a>
            <a href="bookings.php">My Bookings</a>
        </div>
        <div class="nav-actions">
            <div class="user-menu">
                <?php if ($username): ?>
                    <button class="user-button">
                        <i class="fas fa-user"></i>
                        <span><?php echo htmlspecialchars($username); ?></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
                        <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Login</a>
                    <a href="register.php" class="nav-link">Register</a>
                <?php endif; ?>
            </div>
        </div>

    </nav>

    <!-- Hero Section -->
    <header class="hero" id="nav">
        <div class="hero-content">
            <!-- <img src="image/whoosh.webp" alt=""> -->
            <h1>Travel Faster by Train</h1>
            <p>Book your train tickets easily and securely</p>
            <a href="#routes" class="cta-button">Book Now</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Quick Search Section -->
        <section class="search-section">
            <h2>Quick Search</h2>
            <form action="search_routes.php" method="GET" class="search-form">
                <div class="form-group">
                    <label for="departure">From</label>
                    <select name="departure" id="departure" required>
                        <option value="">Select Departure</option>
                        <?php
                        $cities_query = "SELECT DISTINCT departure FROM routes";
                        $cities_result = $conn->query($cities_query);
                        while ($city = $cities_result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($city['departure']) . "'>" .
                                htmlspecialchars($city['departure']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="routes">
                    <label for="destination">To</label>
                    <select name="destination" id="destination" required>
                        <option value="">Select Destination</option>
                        <?php
                        $cities_query = "SELECT DISTINCT destination FROM routes";
                        $cities_result = $conn->query($cities_query);
                        while ($city = $cities_result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($city['destination']) . "'>" .
                                htmlspecialchars($city['destination']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </section>


        <section class="latest-routes">
    <h2>Latest Routes</h2>
    <div class="routes-grid">
        <?php while ($route = $routes_result->fetch_assoc()): ?>
            <div class="route-card">
                <div class="route-info">
                    <div class="route-cities">
                        <span class="departure"><?php echo htmlspecialchars($route['departure']); ?></span>
                        <i class="fas fa-arrow-right"></i>
                        <span class="destination"><?php echo htmlspecialchars($route['destination']); ?></span>
                    </div>
                    <div class="route-price">
                        Rp <?php echo number_format($route['price'], 0, ',', '.'); ?>
                    </div>
                </div>
                <?php if ($username): ?>
                    <a href="book_now.php?route_id=<?php echo $route['id']; ?>" class="book-button">
                        Book Now
                    </a>
                <?php else: ?>
                    <a href="#" class="book-button disabled" onclick="showLoginPopup()">
                        Book Now
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>



        <footer class="footer" id="cont">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About Pri-yok</h3>
                    <p>Your trusted platform for booking train tickets online.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>Email: support@priyok.com</p>
                    <p>Phone: +62-823-3153-1996</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 TrainTix. All rights reserved.</p>
            </div>
        </footer>
        <script>
            document.querySelector('.user-button').addEventListener('click', function() {
                const dropdownMenu = document.querySelector('.dropdown-menu');
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                const dropdown = document.querySelector('.dropdown-menu');
                const button = document.querySelector('.user-button');
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });

            function showLoginPopup() {
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('loginPopup').style.display = 'block';
            }

            function closePopup() {
                document.getElementById('overlay').style.display = 'none';
                document.getElementById('loginPopup').style.display = 'none';
            }

            function goToLogin() {
                window.location.href = 'login.php';
            }

            // Close popup when clicking outside
            document.getElementById('overlay').addEventListener('click', closePopup);
        </script>
</body>

</html>