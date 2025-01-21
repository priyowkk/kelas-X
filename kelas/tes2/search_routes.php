<?php
// Mulai session dan masukkan koneksi ke database
session_start();
include 'includes/db.php';

// Ambil input dari form
$departure = isset($_GET['departure']) ? $_GET['departure'] : null;
$destination = isset($_GET['destination']) ? $_GET['destination'] : null;

// Validasi input
if ($departure && $destination) {
    // Query untuk mencari rute yang sesuai
    $query = "SELECT * FROM routes WHERE departure = ? AND destination = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $departure, $destination);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: white;
            background-image: linear-gradient(135deg, #ffcc00 0%, #ffdb4d 100%);
            color: #000;
        }

        header {
            background-color: #000;
            color: #ffcc00;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .back-link {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #ffcc00;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #fff;
        }

        .back-link i {
            margin-right: 8px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .routes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }

        .route-card {
            background-color: #000;
            border-radius: 15px;
            padding: 25px;
            color: #ffcc00;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .route-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ffcc00, #ffdb4d);
        }

        .route-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .route-info {
            margin-bottom: 20px;
        }

        .route-cities {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .route-cities i {
            color: #ffcc00;
            margin: 0 15px;
            font-size: 1.1em;
        }

        .departure, .destination {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .route-price {
            font-size: 1.8em;
            font-weight: bold;
            margin: 15px 0;
            color: #fff;
        }

        .book-button {
            display: inline-block;
            background: linear-gradient(90deg, #ffcc00, #ffdb4d);
            color: #000;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .book-button:hover {
            background: linear-gradient(90deg, #ffdb4d, #ffcc00);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.3);
        }

        .no-results {
            text-align: center;
            background-color: #000;
            color: #ffcc00;
            padding: 30px;
            border-radius: 15px;
            font-size: 1.2em;
            margin-top: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .routes-grid {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 2em;
            }

            .route-card {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
        <h1>Search Results</h1>
    </header>
    <main class="container">
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="routes-grid">
                <?php while ($route = $result->fetch_assoc()): ?>
                    <div class="route-card">
                        <div class="route-info">
                            <div class="route-cities">
                                <span class="departure"><?php echo htmlspecialchars($route['departure']); ?></span>
                                <i class="fas fa-plane"></i>
                                <span class="destination"><?php echo htmlspecialchars($route['destination']); ?></span>
                            </div>
                            <div class="route-price">
                                Rp <?php echo number_format($route['price'], 0, ',', '.'); ?>
                            </div>
                        </div>
                        <a href="process_order.php?route_id=<?php echo $route['id']; ?>" class="book-button">
                            Book Now
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <i class="fas fa-search" style="font-size: 2em; margin-bottom: 15px;"></i>
                <p>No routes found for your search criteria. Try again!</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>