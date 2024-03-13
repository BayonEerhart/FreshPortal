<?php

include "connect.php";

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("DELETE FROM `employee` WHERE `employee`.`id` = :id");
    $stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();  
} 

header("location: index.php");
exit();