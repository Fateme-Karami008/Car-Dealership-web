<?php
// تنظیمات اتصال به MySQL در XAMPP
$host = "localhost";
$username = "root";
$password = "";
$database = "Shop";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("اتصال به بانک اطلاعاتی برقرار نشد: " . htmlspecialchars(mysqli_connect_error()));
}

mysqli_set_charset($conn, "utf8mb4");
?>