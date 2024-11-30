<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "crud";

try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e->getMessage();
}
