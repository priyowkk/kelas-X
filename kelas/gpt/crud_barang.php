<?php
// Koneksi ke database
$host = "localhost";
$db_name = "dbgpt";
$username = "root";
$password = "";
$conn = null;

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}

// Proses Create, Update, Delete, Read
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        // Create Barang
        $namabarang = $_POST['namabarang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Proses upload gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $gambar_path = 'uploads/' . $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar_path);

            // Insert data ke database
            $query = "INSERT INTO tabelbarang (namabarang, harga, stok, gambar) VALUES (:namabarang, :harga, :stok, :gambar)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':namabarang', $namabarang);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':stok', $stok);
            $stmt->bindParam(':gambar', $gambar_path);

            if ($stmt->execute()) {
                // echo "Barang berhasil ditambahkan!";
            } else {
                // echo "Gagal menambahkan barang!";
            }
        }
    } elseif (isset($_POST['update'])) {
        // Update Barang
        $id = $_POST['id'];
        $namabarang = $_POST['namabarang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Proses upload gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $gambar_path = 'uploads/' . $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar_path);
        } else {
            $gambar_path = $_POST['gambar_lama'];
        }

        // Update data di database
        $query = "UPDATE tabelbarang SET namabarang = :namabarang, harga = :harga, stok = :stok, gambar = :gambar WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':namabarang', $namabarang);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':gambar', $gambar_path);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // echo "Barang berhasil diupdate!";
        } else {
            // echo "Gagal mengupdate barang!";
        }
    }
} elseif (isset($_GET['delete'])) {
    // Delete Barang
    $id = $_GET['delete'];

    // Hapus data dari database
    $query = "DELETE FROM tabelbarang WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // echo "Barang berhasil dihapus!";
    } else {
        // echo "Gagal menghapus barang!";
    }
}

// Menampilkan data barang
$query = "SELECT * FROM tabelbarang";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #fff;
            background-color: #007bff;
            padding: 20px;
            margin: 0;
        }
        h2 {
            color: #007bff;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>CRUD Barang</h1>

<div class="container">
    <!-- Form untuk Menambah Barang -->
    <h2>Tambah Barang</h2>
    <form action="crud_barang.php" method="POST" enctype="multipart/form-data">
        <label>Nama Barang:</label><br>
        <input type="text" name="namabarang" required><br><br>
        <label>Harga:</label><br>
        <input type="number" name="harga" step="0.01" required><br><br>
        <label>Stok:</label><br>
        <input type="number" name="stok" required><br><br>
        <label>Gambar:</label><br>
        <input type="file" name="gambar" required><br><br>
        <input type="submit" name="create" value="Tambah Barang">
    </form>

    <hr>

    <!-- Menampilkan Daftar Barang -->
    <h2>Daftar Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barang_list as $barang): ?>
            <tr>
                <td><?= $barang['id'] ?></td>
                <td><?= $barang['namabarang'] ?></td>
                <td><?= $barang['harga'] ?></td>
                <td><?= $barang['stok'] ?></td>
                <td><img src="<?= $barang['gambar'] ?>" width="100"></td>
                <td>
                    <a href="crud_barang.php?edit=<?= $barang['id'] ?>">Edit</a> |
                    <a href="crud_barang.php?delete=<?= $barang['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['edit'])): ?>
        <?php
        // Ambil data barang yang akan diedit
        $id = $_GET['edit'];
        $query = "SELECT * FROM tabelbarang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $barang_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        
        <hr>
        <h2>Edit Barang</h2>
        <form action="crud_barang.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $barang_edit['id'] ?>">
            <input type="hidden" name="gambar_lama" value="<?= $barang_edit['gambar'] ?>">
            <label>Nama Barang:</label><br>
            <input type="text" name="namabarang" value="<?= $barang_edit['namabarang'] ?>" required><br><br>
            <label>Harga:</label><br>
            <input type="number" name="harga" value="<?= $barang_edit['harga'] ?>" step="0.01" required><br><br>
            <label>Stok:</label><br>
            <input type="number" name="stok" value="<?= $barang_edit['stok'] ?>" required><br><br>
            <label>Gambar:</label><br>
            <input type="file" name="gambar"><br><br>
            <img src="<?= $barang_edit['gambar'] ?>" width="100"><br><br>
            <input type="submit" name="update" value="Update Barang">
        </form>
    <?php endif; ?>
</div>

</body>
</html>
