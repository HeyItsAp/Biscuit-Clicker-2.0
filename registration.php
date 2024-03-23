<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Regisration </title>
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
        body {
            background-color:#D2B48C;
            
            font-family: mr-eaves-xl-modern, sans-serif;
            font-style: normal;
            font-weight: 400;   

        }
        .animation-1 {
            animation: FadeSlideIn 2s ease-in-out;
            opacity: 1;

        }
        .animation-2 {
            animation: FadeSlideIn 2s ease-in-out;
            animation-delay: 2s;
        }
        @keyframes FadeSlideIn {
            from {
                opacity: 0;
                transform: translate(0px, -45px);
            }
            to {
                opacity: 1;
                transform: translate(0px, 0px);
            }
        }

        #mjaau{
            background-color: #D2B48C;
            width: 249px;
            height: 250px;
            position: absolute;
            right: 0px;
            top: 380px;
        } 
    </style>
</head>

<body>
    <?php 
        require_once "php_requires/nav.php";
    ?>
    <div class="container-lg">
        <div class="text-center my-2 animation-1">
            <h2 style="letter-spacing: 12px;"> Welcome to </h2>
        </div>
    </div>
    

    <div class="m-5 animation-2">
        <!-- Stationary cooikie --><!-- <iframe src='https://my.spline.design/untitled-3678d236cbeaee7036a9de60a321974c/' frameborder='0' width='100%' height='450px'></iframe> -->
        <!-- Rotating cookie --><iframe src='https://my.spline.design/untitled-3678d236cbeaee7036a9de60a321974c/' frameborder='0' width='100%' height='450px%'></iframe>

        
    </div>

<div id="mjaau">

</div>

    <div class="container-lg mt-2 p-3 rounded-3" style="background-color:#FFFFFF;">
        <form method="post" action="php_requires/res_h.php">
            <h2>Create your user</h2>
            <div class="mb-3">
                <label for="display_name" class="form-label"> Display name </label>
                <input class="form-control" type="text" name="display_name" placeholder='"BiscuitMaster123"'>
                <p class="form-text">Display name is used to represent you in events and leaderboard</p>
                <p class="form-text">No duplicate display names can be created </p>

            </div>
            <div class="mb-3">
                <label for="display_name" class="form-label"> Username </label>
                <input class="form-control" type="text" name="username" placeholder='"cookiehater"'>
                <p class="form-text">No duplicate username can be created </p>

            </div>
            <div class="mb-3">
                <label for="display_name" class="form-label"> Password </label>
                <input class="form-control" type="text" name="username" placeholder='"ihatecookies"'>
            </div>
            <div>
                <input class="btn btn-primary btn-block" type="submit" name="submitSignUp" value="Create user">
            </div>
        </form> 
    </div>

    <script src="./script.js"></script>
    <!-- Bootstrap 5.3 komponent:-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Used for Popper effect: If you don’t plan to use dropdowns, popovers, or tooltips, save some kilobytes by not including Popper. -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>