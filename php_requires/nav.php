        <nav class="navbar navbar-expand-md navbar-light" style="background-color:#8B4513;">
            <div class="container-xxl">
                <a href="index.php" class="navbar-brand">
                    <img src="medium/Bilder/Mainlogo.png" alt="Biscuit Clicker Logo" width="60" heigh="48">
                </a>
                <a href="https://discord.gg/eEsveqpyyP" class="navbar-brand">
                    <i class="bi bi-discord text-white h4"></i>
                </a>
                <a href="mailto:adrian@gmail.com" class="navbar-brand">
                    <i class="bi bi-envelope text-white h4"></i>
                </a>
                <a href="userSettings.php" class="navbar-brand"><i class="bi bi-person-circle text-white h2"></i></a>
                <?php 
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == true){
                        print '<a href="userSettings.php" class="navbar-brand">';
                        print '<i class="bi bi-person-circle"></i>';
                        echo $_SESSION["Display_Name"];
                        print'</a>';
                    }
                ?>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
                    aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links --><!-- This turn into a dropdown when small -->
                <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link bg-warning rounded-2 px-4 mx-2" data-bs-toggle="modal" data-bs-target="#req-modal2">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="summons.php" class="nav-link text-white mx-2">Summons</a>
                        </li>
                        <li class="nav-item">
                            <a href="items.php" class="nav-link text-white mx-2">Items</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
         <!-- Login modal -->
         <div class="modal fade" id="req-modal2" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog"><!-- Alle the content all the goes here, "The white bubble"-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"> Login </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="php_requires/login_h.php">
                            <label for="username" class="form-label">Username</label>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-chat-right-dots-fill"></i>
                                </span>
                                <input type="email" name="username" class="form-control" placeholder="e.g. Yourmom@example.com">
                            </div>
                            <label for="password" class="form-label"> Password </label>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-asterisk"></i>
                                </span>
                                <input type="text" name="password" class="form-control" placeholder="e.g. Yourmom">
                            </div>
                            <div class="mb-4 input-group">
                            </div>
                    </div>
                    <div class="modal-footer d-flex flex-row justify-content-between">
                        <a href="registration.php" class="link">No user? Make one here </a>
                        <input type="submit" name="submitLogin" class="btn btn-primary" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>