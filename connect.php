<?php

$host = '127.0.0.1';
$db = 'Freshportal';
$user = 'bit';           # vul hier uw database user in
$pass = 'bit';           # vul hier uw database wachtword in
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);
?>