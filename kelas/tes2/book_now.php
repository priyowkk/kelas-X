<?php
session_start();
include 'includes/db.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if (!$username) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $route_id = $_POST['route_id'];
    $booking_date = date('Y-m-d H:i:s');

    $query = "INSERT INTO bookings (username, route_id, booking_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $username, $route_id, $booking_date);

    if ($stmt->execute()) {
        header("Location: bookings.php");
    } else {
        $error = "Error booking the ticket.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .booking-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .booking-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .booking-container .error {
            color: red;
            margin-bottom: 10px;
        }
        .booking-container button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .booking-container button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Confirm Your Booking</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="book_now.php" method="POST">
            <input type="hidden" name="route_id" value="<?php echo $_GET['route_id']; ?>">
            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
