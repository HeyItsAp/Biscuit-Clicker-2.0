<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Biscuit Clicker </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://use.typekit.net/ecv0hnp.css"><!-- Font -->
    <link rel="icon" type="image/x-icon" href="Medium/Bilder/Mainicon.ico">
    <?php
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){?>
        <meta name="Login" content="<?php echo htmlspecialchars($_SESSION['login']); ?>">
    <?php } else { ?>
        <meta name="Login" content="0">
    <?php } ?>
    <style>
    #clicker-biscuit {
        transition: 0.09s; 
        background-image: url("./Medium/Bilder/ClickerCookie.png");
        background-size: 300px;
        position: relative;
        width: 300px;
        height: 300px;

    }
    #clicker-biscuit:hover {
        scale: 1.1;
    }
    #clicker-biscuit:active {
        scale: 0.9;
        transition: 0.09s;
    }
    body {
        background-color:#D2B48C;
        
        font-family: mr-eaves-xl-modern, sans-serif;
        font-style: normal;
        font-weight: 400;
    }
    </style>
</head>
<body>
        <!-- <nav>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="./login.php"> Login </a>
                <a href="./settings.php"> Settings </a>
                <a href="./items.php"> Items </a>
                <a href="./summons.php"> Summons</a>
            </div>
            <?php 
                if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                    echo '<h2 id="login" style="margin: 10px;"> Hello, ' . $_SESSION["Display_Name"] . '</h2>';
                }
            ?>
            <img src="./Medium/Bilder/Mainlogo.png" class="Cookie-menu" onclick="openNav()">
            <div class="Ham-icon" id="Ham-icon-id" onclick="SelectHamIcon(this), openNav()">
                <div class="Ham-icon-1"></div>
                <div class="Ham-icon-2"></div>
                <div class="Ham-icon-3"></div>
            </div>
        </nav> -->
        <?php
            require_once "php_requires/nav.php";
            require_once "php_requires/vital_info.php";
        ?>

        <!-- Main game -->
        <section style="">
            <div class="container-lg">
                <div class="container-fluid">
                    <div class="text-center d-flex flex-column">
                        <h5 class="pt-2"> Biscuits: </h5>
                        <h4 id="biscuit-count"></h4>
                    </div>
                    <div class="text-center">
                        <p id="non-vital-information"></p>
                    </div>
                </div>
                <div class="row">
                    <!-- Cookie -->
                    <div class="col-12 col-md-6 d-flex align-items-center flex-column p-2">
                        <!-- Stats -->
                        <div class="container-fluid text-center">
                            <h3> Stats</h3>
                            <div class="">
                                <p id="biscuit-auto-h2"> <!-- Biscuits per second: <span id="biscuit-auto">0</span> --></p>
                            </div>
                        </div>
                        <div onclick="incrementcount(event)" id="clicker-biscuit"></div>
                    </div>
                    <!-- Store -->
                    <div class="col-12 col-md-6 p-3 rounded-3" style="background-color:#FFFFFF;">
                        <div class="text-start container-fluid">
                            <h2> Biscuit Store</h2>
                        </div>
                        <div class="align-items-center justify-content-center list-group" id="The-upgrades-menu">
                            <?php
                                if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                                    echo '<button id="save" style="" onclick="save_progress()"> Save Progress</button>';
                                }
                            ?>
                        </div>
                        <div class="container-fluid">
                            <h2> Events??!??!?! </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                            <!-- <div id="main-game">
                                <div class="main-game-instructions">
                                    <h2> Welcome to Biscuit Clicker! </h2>
                                    <p> Click the biscuit to bake a cookie, use cookies to buy upgrades. Attain the upgrade Mr. Biscuit WorldWide to win </p>
                                </div>
                                <div class="main-game-info">
                                    <h2> Biscuits: <span id="biscuit-count"></span></h2>
                                    <h2 id="biscuit-auto-h2"> <!-- Biscuits per second: <span id="biscuit-auto">0</span></h2> -->
                                    <!-- <div id="prestige-menu"> 
                                    </div>
                                </div>
                                <img src="./Medium/Bilder/ClickerCookie.png" alt="Click on Biscuit for Biscuits" onclick="incrementcount()" class="clicker-biscuit">
                            </div> -->
                            <!-- 
                            <div id="upgrade-menu">
                                <div id="The-upgrades-menu">
                                    <?php
                                        //if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                                        //    echo '<button id="save" style="" onclick="save_progress()"> Save Progress</button>';
                                        //}
                                    ?>
                                    <!-- <div class="upgrade">
                                        <div class="upgradeheadline">
                                            <h2> More sleep</h2>
                                            <p> Sleeping more makes you make more <span class="bold-text"> Gain 0.1 Cookie pr second</span></p>
                                        </div>
                                        <button onclick="buy()">Get more sleep<br>Pris: <span id="price">12</span><br>Antal: <span id="antal">0</span></button>
                                    </div> -->
                                <!-- </div>
                            </div> -->
                            <!-- <footer>
                                <div class="footer-wrapping">
                                    <h2 class="footer-title"> Kontakt</h2>
                                    <a href="mailto:adrian@gmail.com" class="footer-link">Adrian@gmail.com </a>
                                    <a href="telto:9696969" class="footer-link">&nbsp; +47 96969699</a>
                                    <!-- <a href="" class="footer-link"></a> -->
                        
                                <!-- </div>
                            </footer> -->

       
    <!-- Bootstrap 5.3 komponent:-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Used for Popper effect: If you don’t plan to use dropdowns, popovers, or tooltips, save some kilobytes by not including Popper. -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./script.js"></script>
   
</body>
</html>