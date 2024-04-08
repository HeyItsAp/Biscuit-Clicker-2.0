<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and validate data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $display_name = validate($_POST['display_name']);
    $username = validate($_POST['username']);
    $pwd = validate($_POST['password']);
    echo $display_name . '<br>';
    echo $username . '<br>';
    echo $pwd . '<br>';

    if(empty($username) || empty($pwd) || empty($display_name)) {
        header( "refresh:0; url=../registration.php" );
        echo '<script> alert("Something is missing");</script>';
        die("");
    }


    try {
        require_once "dbh-inc.php"; 

        // For duplicate
            try {
                $query = "SELECT * FROM user WHERE DisplayName = :DisplayName;";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':DisplayName', $display_name);
                $stmt -> execute();
                $Duplicate_display = $stmt ->fetch(PDO::FETCH_ASSOC);
                var_dump($Duplicate_display);
                print $Duplicate_display;
                print_r($Duplicate_display);
    
                $query = "SELECT * FROM user WHERE username = :username;";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':username', $username);
                $stmt -> execute();
                $Duplicate_username = $stmt ->fetch(PDO::FETCH_ASSOC);
                var_dump($Duplicate_username);
                print $Duplicate_username;
                print_r($Duplicate_username);
            } catch (PDOException $e) {
                echo "Connection Error: " . $e->getMessage(); 
            }

            if ($Duplicate_display && $Duplicate_username){
                $pdo = null;
                $stmt = null;  
                header( "refresh:0; url=../registration.php" );
                echo '<script> alert("Something is missing");</script>';
                die("");
            } else {

                $query = "INSERT INTO user (DisplayName, username, pwd) values (:DisplayName, :username, :pwd);";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':DisplayName', $display_name);
                $stmt -> bindParam(':username', $username);
                $stmt -> bindParam(':pwd', $pwd);
                $stmt -> execute();
                $user_id = $pdo -> lastinsertid(); // User id

                $query = "INSERT INTO biscuit_progress (User_id) values (:user_id);";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':user_id', $user_id);
                $stmt -> execute();

                $query = "INSERT INTO upgrades_number (User_id) values (:user_id);";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':user_id', $user_id);
                $stmt -> execute();

                $query = "INSERT INTO items_bool (User_id) values (:user_id);";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':user_id', $user_id);
                $stmt -> execute();
            } 
                // Closing the connection
                $pdo = null;
                $stmt = null;        
                header( "refresh:0; url=../login.php" );
                echo '<script> alert("Sign up sucsess");</script>';
                die("");
            
        } catch (PDOException $e) {
            die("Failed " . $e->getMessage()); // die(); terminater scriptet og printer ut inni ()
        }
        
} else {
    header("Location: ../index.php"); // Sender personen tilbake til index.php hvis det er ingen php
}