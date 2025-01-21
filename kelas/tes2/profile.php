<?php
session_start();
include 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch user data
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $update_query = "UPDATE users SET 
                    name = ?, 
                    email = ?, 
                    phone = ?, 
                    address = ? 
                    WHERE username = ?";
    
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssss", $name, $email, $phone, $address, $username);
    
    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully!";
        // Refresh user data
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } else {
        $error_message = "Error updating profile. Please try again.";
    }
}
$bookings_query = "SELECT * FROM bookings WHERE username = ? ORDER BY booking_date DESC";
$bookings_stmt = $conn->prepare($bookings_query);
$bookings_stmt->bind_param("i", $user['id']);
$bookings_stmt->execute();
$bookings_result = $bookings_stmt->get_result();
$bookings = $bookings_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - TrainTix</title>
    <link rel="stylesheet" href="styles/profile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar (sama seperti halaman utama) -->
    <!-- <nav class="navbar">
        <div class="nav-brand">
            <i class="fas fa-train"></i>
            <img src="image/Pri-Yok.png" alt="">
        </div>
        <div class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="#cont">Contact Us</a>
            <a href="bookings.php">My Bookings</a>
        </div>
        <div class="nav-actions">
            <div class="user-menu">
                <button class="user-button">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($username); ?></span>
                </button>
                <div class="dropdown-menu">
                    <a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
                    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav> -->

    <main class="container">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h1><?php echo htmlspecialchars($user['name'] ?? $username); ?></h1>
                <p class="member-since">Member since: <?php echo date('F Y', strtotime($user['created_at'])); ?></p>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="alert success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="profile-content">
                <form action="profile.php" method="POST" class="profile-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" 
                                value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>"
                                placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" 
                                value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>"
                                placeholder="Enter your email">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                                placeholder="Enter your phone number">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" 
                                value="<?php echo htmlspecialchars($username); ?>"
                                disabled>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3" 
                            placeholder="Enter your address"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="change_password.php" class="btn-password">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                    </div>
                </form>

                <div class="profile-stats">
                    <h2>Account Statistics</h2>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <i class="fas fa-ticket-alt"></i>
                            <span class="stat-number">
                                <?php
                                $bookings_query = "SELECT COUNT(*) as total FROM bookings WHERE username = " . $user['id'];
                                $bookings_result = $conn->query($bookings_query);
                                $bookings_count = $bookings_result->fetch_assoc()['total'];
                                echo $bookings_count;
                                ?>
                            </span>
                            <span class="stat-label">Total Bookings</span>
                        </div>
                        <div class="stat-card">
                            <i class="fas fa-clock"></i>
                            <span class="stat-number">
                                <?php
                                $active_query = "SELECT COUNT(*) as total FROM bookings WHERE username = " . $user['id'] . " AND status = 'active'";
                                $active_result = $conn->query($active_query);
                                $active_count = $active_result->fetch_assoc()['total'];
                                echo $active_count;
                                ?>
                            </span>
                            <span class="stat-label">Active Bookings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle user dropdown menu
        document.querySelector('.user-button').addEventListener('click', function() {
            document.querySelector('.dropdown-menu').classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.user-button') && !event.target.closest('.user-button')) {
                document.querySelector('.dropdown-menu').classList.remove('show');
            }
        });
    </script>
</body>
</html>