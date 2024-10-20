<?php
$dsn = 'mysql:host=localhost;dbname=imsdb';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
}
catch (PDOException $e) {
    $error_message = $e->getMessage();
    //echo "Connection failed: " . $e->getMessage();
}
?>
