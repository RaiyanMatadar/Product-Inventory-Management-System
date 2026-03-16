<?php

$dsn = "mysql:host=localhost;dbname=product_inventory_managment_system";
$dbUsername = "root";
$dbPassword = "";

try {
    $pdo = new PDO($dsn,$dbUsername,$dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $error) {
    echo "connection failed";
}