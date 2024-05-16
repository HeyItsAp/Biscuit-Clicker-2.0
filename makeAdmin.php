<?php
session_start();


if (!isset($_SESSION["login"])){
    header( "refresh:0; url=index.php" );
    echo '<script> alert("You need to be logged in to acsess this");</script>';
}
if ($_SESSION['clearance'] != 1){
    header( "refresh:0; url=index.php" );
    echo '<script> alert("You need to be logged in as admin to acsess this");</script>';
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

        try {
            require_once "php_requires/dbh-inc.php"; 
            $query = "SELECT * FROM user;";
            $stmt = $pdo -> prepare($query);
            $stmt -> execute();
            $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);    
        } catch (PDOExecption $e) {
            die("Failed : " . $e->getMessage()); 
        }


    ?>
    <section class="container-lg mt-5">
        <header class="my-4">
            <h4 class="fs-3">Make Admin:</h4>
            <p> Here you can delete users or make other users admin. Yes, unfortonoaly this is all you can do</p>
        </header>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <?php
                        if ($users){
                            foreach ($users[0] as $key => $row){
                                print '<th scope="col">' . $key . '</th>';
                            }
                            print '<th scope="col"> Buttons </th>';
                        } else {
                            print '<h4 class="fs-3"> Ingen brukrere</h4>';
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php    
                    if ($users){
                        foreach ($users as $key => $row){
                            $id_user = $row['id_user'];
                            $DisplayName = $row['DisplayName'];
                            $username = $row['username'];
                            $pwd = $row['pwd'];
                            $date = $row['date'];
                            $clearance = $row['clearance'];
                            $auto_saving = $row['auto_saving'];

                        ?>
                            <tr>
                                <form method="post" action="php_requires/adminMethod_h.php">
                                <th scope="row"><?php echo $id_user ?></th>
                                <th scope="row"><?php echo $DisplayName ?></th>
                                <th scope="row"><?php echo $username ?></th>
                                <th scope="row">***</th>
                                <th scope="row"><?php echo $date ?></th>
                                <td>
                                    <select name="new_clearance" class="form-select">
                                        <option value="0" class="text-primary" <?php echo $clearance == "0" ? "selected" : "" ?>> Normal Clicker </option>
                                        <option value="1" class="text-success" <?php echo $clearance == "1" ? "selected" : "" ?>> Admin Clicker </option>
                                    </select>
                                </td>
                                <th scope="row"><?php echo $auto_saving == "0" ? "Off" : "On" ?></th>
                                <td>
                                    <?php print '<input type="hidden" name="id_user" value="'. $id_user. '">'; ?>
                                    <button type="submit" name="delete_bruker" class="btn btn-danger mx-1"> Delete </button>
                                    <button type="submit" name="oppdater_clearance" class="btn btn-success mx-1"> Update clearance </button>
                                </td>
                                </form>
                            </tr>
                        <?php
                        }
                    }
                ?>
            </tbody>
        </table>
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