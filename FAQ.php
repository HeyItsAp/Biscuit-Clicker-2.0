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
    <!-- FAQ -->
    <section class="container-lg mt-5">
        <div class="row gap-5 d-flex justify-content-center">

            <!-- One set of questions -->
            <article class="col-12 col-lg-10 my-1">
                <div class="text-start">
                    <h2 class="fs-1">Biscuit Gameplay </h4>
                    <p>If you have questions about the gameplay, terms or mechanics you are unsure about, hope these questions help: </p>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            What is the main goal of the game?
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p> The main goal of the game is reach and upgrade the final upgrade: "Mr. Biscuiut Worldwide". But it is appreactied if u try to get every item too. </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            What is BP or Biscuit Prestige?
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p> Biscuit prestige or BP, is earned through prestiging. Prestiging is avaliable after a set amount of biscuits has been passed. A noticable menu will show up. When prestiging, your biscuit will be turned into 0 and upgrades will be reset. In exchange, you'll get a set amount of biscuit prestige that doesn't disappear. You can use them to buy a mystery box </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            What are the chances in buying a Mystery box.
                        </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p>Currently the rates are: Trash: 60%, Rare: 35%, Epic: 4%, Legendary: 1% </p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- One set of questions -->
            <article class="col-12 col-lg-10 my-1">
                <div class="text-start">
                    <h2 class="fs-1"> Account manangement </h4>
                    <p> If you have problems with handling your account and stuff this section is dedicated to that. </p>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Where do i create a new account?
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p> In the main game, click on the yellow login button. On the bottom left of the click on the link. You'll be sendt to the resgistration page. </p>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How to disable or enable auto save?
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p> You can disable and enable in the account manangement page. Click on your profile figure beside your displayname, when logged in. Yes, only loggedin users can auto-save.</p>
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How to log out?
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>After logging inn, the logg in button turns into logg out button, but without the yellow button. Click on it to logg out.</p>
                        </div>
                        </div>
                    </div>
                    </div>
            </article>
            <!-- Set -->
            <article class="my-1 col-12 col-lg-10">
                <h4 class="fs-1"> How to navigate video </h4>
                <video src="Dokumenter/Navigation.mp4" controls class="w-100">Unable to find video</video>
            </article>

            <!-- Set -->
            <footer class="mb-5 col-12 col-lg-10">
                <h4 class="fs-3">Advanced guides</h4>
                <p> These guide into more detail on how to play and opearate the game: </p>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"><a href="Dokumenter/Tutorial.pdf" download class="btn btn-link"> Tutorial</a></li>
                    <li class="list-group-item"><a href="Dokumenter/Developer.pdf" download class="btn btn-link"> Developer Notes </a></li>
                    <li class="list-group-item"><a href="Dokumenter/Navigation.mp4" download class="btn btn-link"> Intro video (The one above) </a></li>
                </ul>
            </footer>
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