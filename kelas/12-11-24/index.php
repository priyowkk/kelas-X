<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "tokoku";
$koneksi = mysqli_connect($host, $user, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="image/1.jpeg" alt=""></a>
            </div>
            <div class="judul">
                <h2>TokoKu</h2>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="?menu=cart">Cart</a></li>
                    <?php
                    if (!isset($_SESSION["email"])) {
                    ?>
                        <li><a href="?menu=register">Register</a></li>
                        <li><a href="?menu=login">Login</a></li>
                    <?php
                    } else {
                    ?>
                        <li><?= $_SESSION["email"] ?></li>
                        <li><a href="?menu=logout">Logout</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <?php
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
                if ($menu == "cart") {
                    require_once("pages/cart.php");
                }
                if ($menu == "login") {
                    require_once("pages/login.php");
                }
                if ($menu == "register") {
                    require_once("pages/register.php");
                }
                if ($menu == "logout") {
                    require_once("pages/logout.php");
                }
            } else {
                require_once("pages/product.php");
            }
            ?>
        </div>
        <div class="footer">
            <footer>web ini dibuat oleh Priyo Anggodho.</footer>
        </div>
    </div>
</body>

</html>