<?php
$servername = "localhost:3307";
$username = "testuser";
$password = "test11user";
$database = "maktaba_tul_ahadith";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}