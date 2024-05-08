<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data

    $item = $_POST['item'];
    $prestige_count = $_POST['prestige_count'];
    $user_id = $_SESSION['id'];
    var_dump($item);
    print 'BP: ' . $prestige_count . '<br>';
    print 'id: ' . $user_id . '<br>';
    try {
        require_once "dbh-inc.php";
        foreach ($item as $id_item => $bool)  {
            $query = "UPDATE user_has_items SET items_obtained = '1' WHERE item_in_question_id = :item_in_question_id AND user_has_item_id = :user_has_item_id;";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':item_in_question_id', $id_item, PDO::PARAM_STR);
            $stmt -> bindParam(':user_has_item_id', $user_id,PDO::PARAM_INT);
            $stmt -> execute();
        } 

        $query = "UPDATE biscuit_progress SET prestige_count = :prestige_count WHERE id_foregin_user = :id_foregin_user";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':prestige_count', $prestige_count, PDO::PARAM_STR);
        $stmt -> bindParam(':id_foregin_user', $user_id,PDO::PARAM_INT);
        $stmt -> execute();

        $query = null;
        $stmt = null;
        header( "refresh:0; url=../summons.php" );
        echo '<script> alert("Item is saved");</script>';
        die("");
    }   
    catch (PDOExecption $e) {
        die("Failed : " . $e->getMessage()); 
    }
} else {
    header("Location: ../login.php");
}
