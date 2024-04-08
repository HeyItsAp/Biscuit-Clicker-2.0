<?php
session_start();

if (!isset($_SESSION["login"]) && $_SESSION["login"] != true){
    // header( "refresh:0; url=index.php" );
    echo '<script> alert("You need to be logged in to acsess this");</script>';
}
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
    
    <!-- Animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <link rel="icon" type="image/x-icon" href="Medium/Bilder/Mainicon.ico">
    <style>
        #video:-webkit-full-screen[controls],
        #video:-moz-full-screen[controls],
        #video:-ms-fullscreen[controls],
        #video:fullscreen[controls] {
        opacity: 0; /* Controls are hidden when in fullscreen */
        }
        body {
        background-color:#D2B48C;
        
        font-family: mr-eaves-xl-modern, sans-serif;
        font-style: normal;
        font-weight: 400;
    }
    </style>
        <?php
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){?>
        <meta name="Login" content="<?php echo htmlspecialchars($_SESSION['login']); ?>">
    <?php } else { ?>
        <meta name="Login" content="0">
    <?php } ?>
</head>
<body>
    <?php 
        require_once "php_requires/nav.php";
        require_once "php_requires/vital_info.php";

    ?>
    <section class="container-lg d-flex justify-content-center align-items-center flex-column">
        <div id="Summons" style="height: 45%;">
            <p id="Stats"> </p>
            <button onclick="pullItem()" id="summon-button" class="btn btn-success animate__animated animate__bounce animate_infinite">Summon Item!</button>
            <p id="Error-msg"> </p>
            <div id="result" class="result">
                <p id="result-text"> </p>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./script.js"></script>
    <!-- Bootstrap 5.3 komponent:-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Used for Popper effect: If you don’t plan to use dropdowns, popovers, or tooltips, save some kilobytes by not including Popper. -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
   
</body>
</html>