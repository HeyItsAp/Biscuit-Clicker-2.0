<?php
session_start();
function fancyDump($array){
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
}

if (!isset($_SESSION["login"])){
    $upgrades = [];
    try {
        require_once "dbh-inc.php"; 

        $query = "SELECT * FROM upgrades;";
        $stmt = $pdo -> prepare($query);
        $stmt -> execute();
        $result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $upgrades[] = $result;

        $jsonData = json_encode($upgrades);
        echo $jsonData;
    } catch (PDOException $e) {
        die("Failed : " . $e->getMessage()); 
    }
} else {
    echo "False";
    header("Location: ../index.php");
    die("");
    
}
