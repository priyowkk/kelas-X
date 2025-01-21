<?php
session_start();
include 'includes/db.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if (!$username) {
    header("Location: login.php");
    exit();
}

// Handle deletion if requested
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $delete_query = "DELETE FROM bookings WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("is", $booking_id, $username);
    $stmt->execute();
    // Redirect to refresh the page and avoid resubmission
    header("Location: bookings.php");
    exit();
}

$query = "SELECT b.id, r.departure, r.destination, b.booking_date
          FROM bookings b
          JOIN routes r ON b.route_id = r.id
          WHERE b.username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
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
        .bookings-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            width: 100%;
        }
        .bookings-container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .bookings-table {
            width: 100%;
            border-collapse: collapse;
        }
        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .bookings-table th {
            background-color: #f8f8f8;
        }
        .bookings-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .bookings-table .actions {
            text-align: center;
        }
        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .back-button {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="bookings-container">
        <h2>My Bookings</h2>
        <table class="bookings-table">
            <tr>
                <th>Departure</th>
                <th>Destination</th>
                <th>Booking Date</th>
                <th class="actions">Actions</th>
            </tr>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['departure']); ?></td>
                    <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                    <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                    <td class="actions">
                        <form action="bookings.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                            <button type="submit" class="delete-button">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div class="back-button">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
