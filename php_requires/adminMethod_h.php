<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function fancyDump($array){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }
    // Get and validate data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_POST["delete_bruker"])){
        try {
            echo '<script> alert("Deleting ... ");</script>';
            $id_bruker = validate($_POST['id_user']);
            require_once "dbh-inc.php"; 
            $query = "DELETE FROM user WHERE id_user = :id_user;";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':id_user', $id_bruker);
            $stmt -> execute();


            if ($id_bruker == $_SESSION['id']){

                session_unset();
                session_destroy();
                
                header( "refresh:0; url=../index.php" );
                echo '<script> alert("You deleted yourself :D ");</script>';
            }
        
            header( "refresh:0; url=../makeAdmin.php" );
            echo '<script> alert("Submiting worked");</script>';
        } catch (PDOExecption $e){              
            echo "Connection Error: " . $e->getMessage();
        }
    } else if (isset($_POST['oppdater_clearance'])){
        try {
            echo '<script> alert("Submiting new values ... ");</script>';

            $clearance = validate($_POST['new_clearance']);
            $id_bruker = validate($_POST['id_user']);

            require_once "dbh-inc.php"; 
            $query = "UPDATE user SET clearance = :clearance WHERE id_user = :id_user";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':clearance', $clearance);
            $stmt -> bindParam(':id_user', $id_bruker);
            $stmt -> execute();

            if ($id_bruker == $_SESSION['id']){
                $_SESSION['clearance'] = $clearance;
            }

            header( "refresh:0; url=../makeAdmin.php" );
            echo '<script> alert("Submiting worked");</script>';
        } catch (PDOExecption $e){
            echo "Connection Error: " . $e->getMessage();
        }
            
        }
} else {
    header("Location: ../index.php"); // Sender personen tilbake til index.php hvis det er ingen php
}