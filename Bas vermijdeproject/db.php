<?php
$servername = "localhost";
$dbname = 'basproject'; 
$username = 'root'; 
$password = 'root'; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=miniproject", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>