<?php

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
    $DisplayName = validate($_POST['DisplayName']);
    $username = validate($_POST['username']);
    $pwd = validate($_POST['pwd']);
    echo $DisplayName . '<br>';
    echo $username . '<br>';
    echo $pwd . '<br>';

    if(empty($DisplayName) || empty($username) || empty($pwd)) {
        header( "refresh:0; url=../registration.php" );
        echo '<script> alert("Something is missing");</script>';
        die("");
    }


    try {
        require_once "dbh-inc.php"; 

        // For duplicate
            try {
                $query = "SELECT * FROM user WHERE DisplayName = :DisplayName OR username = :username";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':DisplayName', $display_name);
                $stmt -> bindParam(':username', $username);

                $stmt -> execute();
                $duplicate = $stmt ->fetch(PDO::FETCH_ASSOC);
                var_dump($duplicate);
                print $duplicate;
                print_r($duplicate);

            } catch (PDOException $e) {
                echo "Connection Error: " . $e->getMessage(); 
            }

            if ($duplicate){
                $pdo = null;
                $stmt = null;
                if ($duplicate['DisplayName'] == $DisplayName){
                    header( "refresh:0; url=../registration.php" );
                    echo '<script> alert("Your display name is already taken");</script>';
                    die("");
                } else if ($duplicate['username'] == $username){
                    header( "refresh:0; url=../registration.php" );
                    echo '<script> alert("Username is taken");</script>';
                    die("");
                }
            } else {

                $query = "INSERT INTO user (DisplayName, username, pwd) values (:DisplayName, :username, :pwd);";
                $stmt = $pdo -> prepare($query);
                $stmt -> bindParam(':DisplayName', $DisplayName);
                $stmt -> bindParam(':username', $username);
                $stmt -> bindParam(':pwd', $pwd);
                $stmt -> execute();
                $user_id = $pdo -> lastinsertid(); // User id

            } 
                // Closing the connection
                $pdo = null;
                $stmt = null;        
                header( "refresh:0; url=../index.php" );
                echo '<script> alert("Sign up sucsess");</script>';
                die("");
            
        } catch (PDOException $e) {
            die("Failed " . $e->getMessage()); // die(); terminater scriptet og printer ut inni ()
        }
        
} else {
    header("Location: ../index.php"); // Sender personen tilbake til index.php hvis det er ingen php
}