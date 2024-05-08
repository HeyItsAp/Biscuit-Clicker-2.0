<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data

    $upgrades = $_POST['upgrades'];
    $biscuit_progress = $_POST['biscuit_progress'];
    $user_id = $_SESSION['id'];
    
    echo $user_id;
    echo '<pre>';
    print_r($upgrades);
    echo '</pre>';
    echo '<pre>';
    print_r($biscuit_progress);
    echo '</pre>';

    try {
        require_once "dbh-inc.php"; 
        foreach ($upgrades as $id_upgrade => $count)  {
            $query = "UPDATE user_has_upgrades SET upgrade_antall = :upgrade_count WHERE user_has_upgrade_id = :user_has_upgrade_id AND upgrade_in_question_id = :upgrade_in_question_id";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':upgrade_count', $count, PDO::PARAM_INT);
            $stmt -> bindParam(':user_has_upgrade_id', $user_id,PDO::PARAM_INT);
            $stmt -> bindParam(':upgrade_in_question_id', $id_upgrade,PDO::PARAM_INT);

            $stmt -> execute();
        } 
        foreach ($biscuit_progress as $biscuit_stat => $count)  {
            $query = "UPDATE biscuit_progress SET `$biscuit_stat` = :stat_count WHERE id_foregin_user = :id_foregin_user";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':stat_count', $count, PDO::PARAM_INT);
            $stmt -> bindParam(':id_foregin_user', $user_id,PDO::PARAM_INT);
            $stmt -> execute();
        } 
 

    }   
    catch (PDOExecption $e) {
        die("Failed : " . $e->getMessage()); 
    }
    $query = null;
    $stmt = null;
    header( "refresh:0; url=../index.php" );
    if (!isset($_POST['auto_saving'])){
        echo '<script> alert("Good job, You remembered to save");</script>';
    }
    die("");
} else {
    header("Location: ../login.php");
}
