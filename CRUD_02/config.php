<?php
// DATABASE CONFIGURATION
try{
    $db_Host = "localhost";
    $db_User = "root";
    $db_Pass = "";
    $db_Database = "crud";

    $db_Connection = new PDO("mysql:host=$db_Host;dbname=$db_Database", $db_User, $db_Pass);
    $db_Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
