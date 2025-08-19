<?php
// db.php
$host = "localhost";
$dbname = "study_planner_db";  // we will create this database in phpMyAdmin
$username = "root"; // default XAMPP username
$password = "";     // default XAMPP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
