<?php

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "db";

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
} catch (Exeption $e) {
    echo "error: " . $e->getMessage();
}