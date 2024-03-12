<?php

$host = '127.0.0.1';
$db = 'Freshportal';
$user = 'bit';
$pass = 'bit';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("DELETE FROM `employee` WHERE `employee`.`id` = :id");
    $stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();
    
} 

header("location:index.php");
exit();