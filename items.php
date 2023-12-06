<?php
session_start();

if (!isset($_SESSION["login"]) && $_SESSION["login"] != true){
    header( "refresh:0; url=login.php" );
    echo '<script> alert("You need to be logged in to acsess this");</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Your Items </title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="Medium/Bilder/Mainicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <?php
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){?>
        <meta name="Login" content="<?php echo htmlspecialchars($_SESSION['login']); ?>">
    <?php } else { ?>
        <meta name="Login" content="0">
    <?php } ?>

</head>
<body>
    <!-- <nav>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="./settings.html"> Settings </a>
            <a href="./items.html"> Items </a>
            <a href="./summons.html"> Summons</a>
            <a href="./login.html"> Login / Logout</a>
        </div>
        <a href="./index.html" class="Maingamelink"> &lt; Main Game</a>
        <img src="./Medium/Bilder/Mainlogo.png" class="Cookie-menu" onclick="openNav()">
        <div class="Ham-icon" id="Ham-icon-id" onclick="SelectHamIcon(this), openNav()">
            <div class="Ham-icon-1"></div>
            <div class="Ham-icon-2"></div>
            <div class="Ham-icon-3"></div>
        </div>
    </nav> -->
    <?php 
        require_once "php_requires/nav_noindex.php";
    ?>
    <div class="items-wrapper">
        <h1> Your items </h1>
        <div class="items-mcontainer">
            <form method="get" id="items">
                <!-- items printing by javascript -->
            </form>
        </div>
    </div>
    <footer>
        <div class="footer-wrapping">
            <h2 class="footer-title"> Kontakt</h2>
            <a href="mailto:adrian@gmail.com" class="footer-link">Adrian@gmail.com </a>
            <a href="telto:9696969" class="footer-link">&nbsp; +47 96969699</a>
            <!-- <a href="" class="footer-link"></a> -->

        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>