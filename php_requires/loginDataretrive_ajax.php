<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    function fancyDump($array){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }

session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
    $user_information = [];
    $user_id = $_SESSION['id'];
    try {
        require_once "dbh-inc.php"; 
        $query = "SELECT id_upgrades, upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_antall, upgrade_value, upgrade_cost, upgrade_des FROM user_has_upgrades INNER JOIN upgrades ON user_has_upgrades.upgrade_in_question_id = upgrades.id_upgrades WHERE user_has_upgrade_id = :id_user;";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':id_user', $user_id);        
        $stmt -> execute();
        $upgrades_result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $user_information['upgrades'] = $upgrades_result;

        $query = "SELECT id_items, item_navn, item_increase, item_rarity, item_beskrivelse, items_obtained FROM user INNER JOIN user_has_items ON user.id_user = user_has_items.user_has_item_id INNER JOIN items ON user_has_items.item_in_question_id = items.id_items WHERE id_user = :id_user;";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':id_user', $user_id);        
        $stmt -> execute();
        $items_result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $user_information['items'] = $items_result ;

        $query = "SELECT auto_saving, biscuit_count, prestige_count FROM user INNER JOIN biscuit_progress ON user.id_user = biscuit_progress.id_foregin_user WHERE id_user = :id_user;";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':id_user', $user_id);        
        $stmt -> execute();
        $biscuit_result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        $user_information['biscuit_progress'] = $biscuit_result;
        
        $jsonData = json_encode($user_information);
        echo $jsonData;
    } catch (PDOException $e) {
        die("Failed : " . $e->getMessage()); 
    }
} else {
    echo "False";
    die("");
    
}