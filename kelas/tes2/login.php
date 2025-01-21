<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "train_ticket";

// Buat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);
    
    // Validasi input
    if (empty($username) || empty($password) || empty($role)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } else {
        // Cek username, password, dan role
        $check_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
        $check_result = mysqli_query($koneksi, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            if ($role == 'admin') {
                echo "<script>
                        
                        window.location.href='admin_dashboard.php';
                    </script>";
            } else {
                echo "<script>
                        
                        window.location.href='index.php';
                    </script>";
            }
        } else {
            echo "<script>window.location.href='login_error.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #FFD700, #000);
            color: #fff;
        }

        .login-container {
            background: #000;
            color: #FFD700;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
        }

        .login-container h2 {
            text-align: center;
            color: #FFD700;
            margin-bottom: 1.5rem;
            font-weight: 700;
            position: relative;
            overflow: hidden;
        }

        .login-container h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #FFD700;
            transition: all 0.3s ease;
        }

        .login-container:hover h2:after {
            width: 100%;
            left: 0;
        }

        .form-control {
            border: 1px solid #FFD700;
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            background-color: #000;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .form-control:hover {
            transform: translateX(5px);
            border-color: #FFD700;
            box-shadow: 2px 2px 8px rgba(255, 215, 0, 0.2);
        }

        .form-control:focus {
            transform: translateX(5px);
            border-color: #FFD700;
            box-shadow: 4px 4px 12px rgba(255, 215, 0, 0.3);
            outline: none;
        }

        .form-control input {
            color: white;
        }

        .form-select {
            background-color: #000;
            color: #FFD700;
            border: 1px solid #FFD700;
            transition: all 0.3s ease;
        }

        .form-select:hover {
            transform: translateX(5px);
            box-shadow: 2px 2px 8px rgba(255, 215, 0, 0.2);
        }

        /* .form-select:focus {
            background-color: #000;
            color: #FFD700;
            border-color: #FFD700;
            box-shadow: 4px 4px 12px rgba(255, 215, 0, 0.3);
        } */

        .form-label {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .form-control:focus + .form-label,
        .form-control:hover + .form-label {
            transform: translateX(5px);
            color: #FFD700;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #FFD700, #000);
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(255, 215, 0, 0.3), transparent);
            transition: all 0.5s ease;
        }

        button:hover:before {
            left: 100%;
        }

        button:hover {
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            transition: transform 0.3s ease;
        }

        .login-link:hover {
            transform: translateY(-3px);
        }

        .login-link a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
            position: relative;
        }

        .login-link a:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #FFD700;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease;
        }

        .login-link a:hover:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 1.5rem;
            }

            .login-container h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Welcome Back</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected style="color: #fff;">Select your role</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <button type="submit">Login</button>
        </form>
        <div class="login-link mt-3">
            Don't have an account? <a href="register.php">Sign up here</a>
        </div>
    </div>
</body>
</html>