<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: center;
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .error-container h1 {
            font-size: 24px;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .error-container p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .error-container a {
            display: inline-block;
            text-decoration: none;
            background-color: #007bff;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .error-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Login Failed</h1>
        <p>Oops! The username,role or password you entered is incorrect. Please try again.</p>
        <a href="login.php">Return to Login</a>
    </div>
</body>
</html>
