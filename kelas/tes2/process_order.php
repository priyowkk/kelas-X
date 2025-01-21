<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $route_id = $_POST['route_id'];
    $customer_name = $_SESSION['username']; // Assuming user is logged in and username is stored in session

    // Get route details
    $route_query = "SELECT * FROM routes WHERE id = ?";
    $stmt = $conn->prepare($route_query);
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $route = $stmt->get_result()->fetch_assoc();

    if ($route) {
        $quantity = 1; // Default to 1 ticket per order
        $total_price = $route['price'] * $quantity;

        // Insert order into database
        $order_query = "INSERT INTO orders (route_id, customer_name, quantity, total_price, order_date) VALUES (?, ?, ?, ?, NOW())";
        $order_stmt = $conn->prepare($order_query);
        $order_stmt->bind_param("isid", $route_id, $customer_name, $quantity, $total_price);
        $order_stmt->execute();

        $order_success = $order_stmt->affected_rows > 0;
    } else {
        $order_success = false;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href="styles/process.css">
</head>
<body>
    <div class="container">
        <?php if (isset($order_success) && $order_success): ?>
            <div class="success-message">
                Selamat, pesanan Anda sudah dibuat!
            </div>
        <?php else: ?>
            <div class="error-message">
                Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.
            </div>
        <?php endif; ?>
        <a href="index.php" class="btn-home">Kembali ke Beranda</a>
    </div>
</body>
</html>