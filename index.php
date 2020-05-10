<!DOCTYPE html>
<html>
    <head>
        <?php
            require "partials/meta.php";
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                session_destroy();
            }
            if (!isset($_SESSION["error"])) {
                $_SESSION["error"] = NULL;
            }

            if ((isset($_SESSION["error"])) or ($_SESSION["error"] != "")) {
                echo "<script>alert('".$_SESSION["error"]."');</script>";
                $_SESSION["error"] = "";
            }
        ?>
    </head>

    <body>
        <br><br><br><br>
        <div class="loginCard">
            <h1>Welcome</h1>
            <?php
                require "partials/login_form.php";
                require "partials/register_form.php";
            ?>

        </div>
        <script src="JS/signup.js"></script>
    </body>
</html>