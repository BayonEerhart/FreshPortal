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
$adres = $_POST['adres'];
$birthdate = $_POST['age'];


function email_check($pdo, $email, $id) 
{

    $sql = "SELECT email FROM employee WHERE id = (?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $dbmail = $stmt->fetchColumn(); 

    $sql = "SELECT email FROM employee WHERE email =  :mail";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':mail', $email);
        $result = $stmt->execute();

    $amount = $stmt->fetchColumn();

    if ($dbmail == $email){
        return false;
    } elseif ($amount){
        return true;
    } else {
        return false;
    } 
} 



if (isset($_POST["id"]) && $_POST["id"] != "") {
    $id = $_POST["id"];
    if (email_check($pdo, $email, $id)) {
        header("Location: index.php?firstName=$firstName&lastName=$lastName&email=$email&adres=$adres&age=$birthdate&id=$id");
        exit(); 
    } 
    $stmt = $pdo->prepare("UPDATE employee SET firstname=?, lastname=?, email=?, address=?, birthdate=? WHERE id=?");
    $stmt->execute([$firstName, $lastName, $email, $adres, $birthdate, $id]);
    header("Location: index.php");
    exit();

} else {
    $id = -1;
    if (email_check($pdo, $email, $id)) {
        header("Location: index.php?firstName=$firstName&lastName=$lastName&email=$email&adres=$adres&age=$birthdate");
        exit(); 
    } 
    $stmt = $pdo->prepare("INSERT INTO employee (firstname, lastname, email, address, birthdate) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $adres, $birthdate]);
    header("Location: index.php");
    exit(); 
}