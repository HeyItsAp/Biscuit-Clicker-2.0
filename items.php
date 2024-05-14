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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="Medium/Bilder/Mainicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/ecv0hnp.css"><!-- Font -->
    <?php
    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){?>
        <meta name="Login" content="<?php echo htmlspecialchars($_SESSION['login']); ?>">
    <?php } else { ?>
        <meta name="Login" content="0">
    <?php } ?>
    <style>
        .hover {
            scale: 1;
            transition: 0.5s ease-in-out;
        }
            .hover:hover {
                scale:1.04;
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
    <?php 
        require_once "php_requires/nav.php";
    ?>
    <section class="container-lg my-5">
        <div class="text-center rounded p-4 bg-white">
            <h1> Your items </h1>
            <p> Your items are permanent upgrades and increase you biscuit count per click. Get items by buying  A Mystery Box.</p>
            <p id="increment_value"></p>
            <div class="container">
                <div id="items" class="row my-5 align-items-center justify-content-center g-3">
                    <!-- items printing by javascript -->
                </div>
            </div>
        </div>
    </section>


    <!-- Bootstrap 5.3 komponent:-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Used for Popper effect: If you don’t plan to use dropdowns, popovers, or tooltips, save some kilobytes by not including Popper. -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./script.js"></script>
</body>

</html> 