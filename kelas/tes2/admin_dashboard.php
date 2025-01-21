<?php
include 'includes/db.php';

// Fetch all routes
$query = "SELECT * FROM routes";
$result = $conn->query($query);

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM routes WHERE id = $delete_id";
    $conn->query($delete_query);
    header("Location: admin_dashboard.php"); // Refresh page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/admin_dashboard.css">
</head>

<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Manage Train routes</h2>
        <div class="logout-container">
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <!-- Form to Add/Edit Ticket -->
        <div class="ticket-form">
            <form action="ticket_process.php" method="POST">
                <input type="hidden" name="id" id="ticket_id">

                <label for="departure">Departure:</label>
                <select name="departure" id="departure" required>
                    <option value="">Select Departure City</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Malang">Malang</option>
                    <option value="Kediri">Kediri</option>
                    <option value="Madiun">Madiun</option>
                    <option value="Blitar">Blitar</option>
                    <option value="Probolinggo">Probolinggo</option>
                    <option value="Pasuruan">Pasuruan</option>
                    <option value="Banyuwangi">Banyuwangi</option>
                    <option value="Jember">Jember</option>
                    <option value="Sidoarjo">Sidoarjo</option>
                </select>

                <label for="destination">Destination:</label>
                <select name="destination" id="destination" required>
                    <option value="">Select Destination City</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Malang">Malang</option>
                    <option value="Kediri">Kediri</option>
                    <option value="Madiun">Madiun</option>
                    <option value="Blitar">Blitar</option>
                    <option value="Probolinggo">Probolinggo</option>
                    <option value="Pasuruan">Pasuruan</option>
                    <option value="Banyuwangi">Banyuwangi</option>
                    <option value="Jember">Jember</option>
                    <option value="Sidoarjo">Sidoarjo</option>
                </select>

                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required step="0.01">

                <button type="submit">Save Ticket</button>
            </form>
        </div>


        <!-- routes Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['departure']; ?></td>
                        <td><?= $row['destination']; ?></td>
                        <td>Rp<?= number_format($row['price'], 2); ?></td>
                        <td>
                            <button class="edit-btn"
                                data-id="<?= $row['id']; ?>"
                                data-departure="<?= $row['departure']; ?>"
                                data-destination="<?= $row['destination']; ?>"
                                data-price="<?= $row['price']; ?>">Edit</button>
                            <button style="background-color: red;"><a href="admin_dashboard.php?delete_id=<?= $row['id']; ?>" style="color: white;">Delete</a></button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Fill the form with ticket data for editing
        const editButtons = document.querySelectorAll('.edit-btn');
        const ticketId = document.getElementById('ticket_id');
        const departure = document.getElementById('departure');
        const destination = document.getElementById('destination');
        const price = document.getElementById('price');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                ticketId.value = button.getAttribute('data-id');
                departure.value = button.getAttribute('data-departure');
                destination.value = button.getAttribute('data-destination');
                price.value = button.getAttribute('data-price');
            });
        });
    </script>
</body>

</html>