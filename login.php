<?php
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
    header( "refresh:0; url=index.php" );
    echo '<script> alert("You are already logged in, log out in settings");</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="Medium/Bilder/Mainicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
    <div class="login-dark">
        <form method="POST" action="php_requires/Login_h.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <a href="registration.php"> No account? Create one here.</a>

        </form> 
        <!-- Log out: -->
        <!-- <form>
            <p> Du er logget in </p><br>
            <p> Vil du logge ut? </p>
            <button class="btn btn-primary btn-block" onclick="">Log ut</button>
        </form> -->
    </div>
    <footer>
        <div class="footer-wrapping">
            <h2 class="footer-title"> Kontakt</h2>
            <a href="mailto:adrian@gmail.com" class="footer-link">Adrian@gmail.com </a>
            <a href="telto:9696969" class="footer-link">&nbsp; +47 96969699</a>
            <!-- <a href="" class="footer-link"></a> -->

        </div>
    </footer>
    <script src="./script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>