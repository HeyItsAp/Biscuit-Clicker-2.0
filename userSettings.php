<?php
session_start();

if (!isset($_SESSION["login"]) && $_SESSION["login"] != true){
    header( "refresh:0; url=index.php" );
    echo '<script> alert("You need to be logged in to acsess this");</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
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
    <section class="container-lg my-5 p-3 rounded-3" style="background-color: #FFFFFF;">
        <form method="post" action="php_requires/settings_h.php">
            <h2> Update your account</h2>
            <p class="">All input must be filled, for security reasons.</p>

            <div class="mb-2">
                <label for="new_display" class="form-label"> Display name </label>
                <input class="form-control" type="text" name="new_display" placeholder='<?php echo $_SESSION['Display_Name']; ?>' required>
                <p class="form-text">Display name is used to represent you in events and leaderboard</p>
                <p class="form-text">No duplicate display names can be created </p>

            </div>
            <div class="mb-2">
                <label for="new_username" class="form-label"> Username </label>
                <input class="form-control" type="text" name="new_username" placeholder='<?php echo $_SESSION['username']; ?>' required>
                <p class="form-text">No duplicate username can be created </p>

            </div>
            <div class="mb-2">
                <label for="new_password" class="form-label"> Password </label>
                <input class="form-control" type="password" name="new_password" placeholder='new password' required>
            </div>
            <div class="mb-2">
                <label for="confirm_password" class="form-label"> Confirm Password </label>
                <input class="form-control" type="password" name="confirm_password" placeholder='new password again' required>
            </div>
            <div>
                <label for="Switch" class="form-label"> Auto save </label>
            </div>
            <div class="form-check form-switch mb-2 mt-0">
                <input class="form-check-input" type="checkbox" role="switch" id="Switch" name="auto_save" <?php echo $_SESSION['autosaving'] == 1 ? "checked" : ""?> >
                <label class="form-check-label" for="Switch">Enable auto saving</label>
            </div>
            <div>
                <p class="form-text">Saving will accur every 5 minutes, and will automatically refresh your page </p>
            </div>
            <div>
                <input class="btn btn-primary btn-block" type="submit" name="submitSignUp" value="Update">
            </div>
        </form>
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