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
    /* For +1 effects */
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
            require_once "php_requires/vital_info.php";
        ?>

        <!-- Main game -->
        <section class="container-lg mt-5">
            <div class="container-lg">
                <div class="text-center d-flex flex-column">
                    <h5 class="pt-2"> Biscuits: </h5>
                    <h4 id="biscuit-count" class="fs-2 rounded mx-auto w-25 py-2" style="background-color: #FFFFFF;"></h4>
                </div>
                <div class="text-center my-3">
                    <p id="non-vital-information" class="my-3">
                    </p>
                    <!-- Prestige menu -->
                    <div id="prestige-menu" class="flex-column text-center justify-content-center align-items-center rounded py-3" style="background-color:#FFFFFF; display: none;">
                        <h4 class="fw-bold"> Prestige </h4>
                        <p><span class="fs-4 fw-bold" style="color:#FF69B4;">Warning: </span> Prestiging resets your biscuit progress, and forces a save</p>
                    </div>
                </div>
            </div>
            <div class="row gap-3" >
                <!-- Cookie -->
                <div class="col-12 col-md-8 d-flex align-items-center flex-column rounded py-3" style="background-color:#FFFFFF;">
                    <!-- Stats -->
                    <div class="container-fluid text-center border border-secondary mb-4 py-2">
                        <h3>Stats</h3>
                        <div>
                            <p id="biscuit-auto-h2" class="mb-1"> <!-- Biscuits per second: <span id="biscuit-auto">0</span> --></p>
                            <p id="prestige-show-stats" class="mb-1"> <!-- Biscuits per second: <span id="biscuit-auto">0</span> --></p>
                        </div>
                    </div>
                    <div onclick="incrementcount(event)" id="clicker-biscuit"></div>
                </div>
                <!-- Store -->
                <div class="col-12 col-md-3 p-3 rounded-3" style="background-color:#FFFFFF;">
                    <div class="text-start container-fluid">
                        <h2> Biscuit Store</h2>
                    </div>
                    <div class="align-items-center justify-content-center list-group" id="The-upgrades-menu">
                        <?php
                            if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                                echo '<button id="save" class="w-100 btn hover" style="background-color:#00ff00;" onclick="save_progress(false)"> Save Progress</button>';
                            }
                        ?>
                    </div>
                    <!-- EEVENT ===!=!=!==! -->
                    <!-- <div class="container-fluid">
                        <h2> Events??!??!?! </h2>
                    </div> -->
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