<?php
$mysqli = require_once __DIR__ . '/../lib/db.php';

$username = 'admin';
$email = 'admin@study-share.site';
$password = password_hash('yourpassword', PASSWORD_BCRYPT);

$admin_school_id = 1; // Set to an existing approved school ID
$admin_degree_id = 1; // Set to an existing degree ID for that school

// Manual insert
$stmt = $mysqli->prepare("INSERT INTO users (username, email, password_hash, degree_id, school_id, is_admin) VALUES (?, ?, ?, ?, ?, 1)");
$stmt->execute([$username, $email, $password, $admin_degree_id, $admin_school_id]);

echo "Admin created successfully! Delete this file immediately.";