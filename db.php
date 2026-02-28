<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "mixup_db";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4"); // Щоб укр мова відображалася коректно

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
?>