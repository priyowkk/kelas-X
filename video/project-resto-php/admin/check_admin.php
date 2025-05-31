<?php
require_once dirname(__FILE__) . '/../config/database.php';

// Check if admin exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = 'admin'");
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

if (!$admin) {
    // Create admin if not exists
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $username, $password, $email);
    
    $username = 'admin';
    $email = 'admin@resto.com';
    
    if ($stmt->execute()) {
        echo "Admin account created successfully!\n";
        echo "Username: admin\n";
        echo "Password: admin123\n";
    } else {
        echo "Failed to create admin account.\n";
    }
} else {
    if ($admin['role'] !== 'admin') {
        // Update role to admin if necessary
        $stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE username = 'admin'");
        if ($stmt->execute()) {
            echo "Admin role updated successfully!\n";
        }
    }
    echo "Admin account exists.\n";
    echo "Username: admin\n";
    echo "Role: " . $admin['role'] . "\n";
    echo "Status: " . ($admin['is_active'] ? 'Active' : 'Inactive') . "\n";
}

// Ensure admin is active
if (!$admin['is_active']) {
    $stmt = $conn->prepare("UPDATE users SET is_active = 1 WHERE username = 'admin'");
    if ($stmt->execute()) {
        echo "Admin account activated successfully!\n";
    }
}
?>
