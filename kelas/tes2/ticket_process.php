<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];

    if ($id) {
        // Update ticket
        $query = "UPDATE routes SET departure = '$departure', destination = '$destination', price = $price WHERE id = $id";
    } else {
        // Add new ticket
        $query = "INSERT INTO routes (departure, destination, price) VALUES ('$departure', '$destination', $price)";
    }

    $conn->query($query);
    header("Location: admin_dashboard.php");
    exit;
}
?>
