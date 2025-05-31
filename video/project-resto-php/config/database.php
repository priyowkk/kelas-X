<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'resto_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db(DB_NAME);

// Create tables
$tables = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        role ENUM('admin', 'user') DEFAULT 'user',
        is_active BOOLEAN DEFAULT true,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    "CREATE TABLE IF NOT EXISTS menu_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    "CREATE TABLE IF NOT EXISTS menu_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255),
        is_available BOOLEAN DEFAULT true,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES menu_categories(id)
    )",
    
    "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        table_number INT,
        status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
        total_amount DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )",
    
    "CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT,
        menu_item_id INT,
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES orders(id),
        FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
    )"
];

foreach ($tables as $sql) {
    if ($conn->query($sql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }
}

// Insert default admin user
$default_admin = "INSERT INTO users (username, password, email, role) 
                 SELECT 'admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'admin@resto.com', 'admin'
                 WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin')";
$conn->query($default_admin);

// Insert some default categories
$default_categories = [
    "INSERT INTO menu_categories (name) SELECT 'Main Course' WHERE NOT EXISTS (SELECT 1 FROM menu_categories WHERE name = 'Main Course')",
    "INSERT INTO menu_categories (name) SELECT 'Appetizers' WHERE NOT EXISTS (SELECT 1 FROM menu_categories WHERE name = 'Appetizers')",
    "INSERT INTO menu_categories (name) SELECT 'Desserts' WHERE NOT EXISTS (SELECT 1 FROM menu_categories WHERE name = 'Desserts')",
    "INSERT INTO menu_categories (name) SELECT 'Beverages' WHERE NOT EXISTS (SELECT 1 FROM menu_categories WHERE name = 'Beverages')"
];

foreach ($default_categories as $sql) {
    $conn->query($sql);
}
?>
