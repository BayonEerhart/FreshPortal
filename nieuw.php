<?php

if (!(
    isset($_POST["firstName"])  && ($_POST["firstName"]) != ""  && 
    isset($_POST["lastName"])  && ($_POST["lastName"]) != ""  && 
    isset($_POST["email"])  && ($_POST["email"]) != ""  && 
    isset($_POST["adres"])  && ($_POST["adres"]) != ""  && 
    isset($_POST["age"])  && ($_POST["age"]) != "")){
    header("location:index.php");
    exit();
}

$host = '127.0.0.1';
$db = 'Freshportal';
$user = 'bit';
$pass = 'bit';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$address = $_POST['adres'];
$birthdate = $_POST['age'];
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $stmt = $pdo->prepare("UPDATE employee SET firstname=?, lastname=?, email=?, address=?, birthdate=? WHERE id=?");
    $stmt->execute([$firstName, $lastName, $email, $address, $birthdate, $id]);
    header("Location: index.php");
    exit(); // Stop further execution

} else {
    $stmt = $pdo->prepare("INSERT INTO employee (firstname, lastname, email, address, birthdate) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $address, $birthdate]);
    header("Location: index.php");
    exit(); 
}