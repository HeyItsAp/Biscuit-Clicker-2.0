<?php
    $dsn = "mysql:host=localhost;dbname=biscuitclicker2";
    if (isset($_SESSION['clearance']) && $_SESSION['clearance'] == 1){
        $dbusername = "adminClicker";
        $dbpassword = "admin123";
    } else {
        $dbusername = "userClicker";
        $dbpassword = "user123";
    }
    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch (PDOExecption $e){
        echo "Connection Error: " . $e->getMessage(); 
    }