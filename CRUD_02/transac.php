<?php

require_once("config.php");

$fname = filter_var($_POST["firstname"], FILTER_SANITIZE_SPECIAL_CHARS);
$last_Name = filter_var($_POST["lastname"], FILTER_SANITIZE_SPECIAL_CHARS);
$mid_Name = filter_var($_POST["Middlename"], FILTER_SANITIZE_SPECIAL_CHARS);
$address = filter_var($_POST["address"], FILTER_SANITIZE_SPECIAL_CHARS);
$contact = $_POST["Contact"];
$comment = $_POST["Comment"];

if(isset($_POST["action"])){
    $query = ("INSERT INTO people (first_name, last_name, mid_name, address, contact, comment) VALUES(?,?,?,?,?,?)");
    $stmt = $db_Connection->prepare($query);
    $stmt->bindParam(1, $fname, PDO::PARAM_STR);
    $stmt->bindParam(2, $last_Name, PDO::PARAM_STR);
    $stmt->bindParam(3, $mid_Name, PDO::PARAM_STR);
    $stmt->bindParam(4, $address, PDO::PARAM_STR);
    $stmt->bindParam(5, $contact, PDO::PARAM_STR);
    $stmt->bindParam(6, $comment, PDO::PARAM_STR);

    $stmt->execute();
    $stmt = null;
}