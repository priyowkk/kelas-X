<?php include 'includes/db.php'; ?>
<?php
$route_id = $_GET['route_id'];
$route = $conn->query("SELECT * FROM routes WHERE id = $route_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket</title>
    <link rel="stylesheet" href="styles/order.css">
</head>
<body>
    <h1>Pesan Tiket Kereta</h1>
    <form action="process_order.php" method="POST">
        <input type="hidden" name="route_id" value="<?php echo $route['id']; ?>">
        <p><strong>Rute:</strong> <?php echo $route['departure'] . " ke " . $route['destination']; ?></p>
        <p><strong>Harga per Tiket:</strong> <?php echo $route['price']; ?></p>
        <label for="customer_name">Nama Anda:</label>
        <input type="text" name="customer_name" required>
        <label for="quantity">Jumlah Tiket:</label>
        <input type="number" name="quantity" required>
        <button type="submit">Pesan</button>
    </form>
</body>
</html>
