<?php
declare(strict_types=1);

// Step 1: connect with new PDO($dsn, $username, $password)
$dsn = 'mysql:host=localhost;dbname=my_guitar_shop2;charset=utf8mb4';
$username = 'root';
$password = '';

// Step 2: wrap it in try/catch
try{
    $db = new PDO($dsn, $username, $password);
    echo("Successfully linked to database");
} catch(PDOException $e){
    echo($e->getMessage());
}