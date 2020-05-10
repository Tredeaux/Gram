<!DOCTYPE html>
<html>
    <head>
        <?php
            require "SQL/connect.php";
            require "partials/meta.php";

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (($_SESSION["username"]) == "") {
                header("Location: index.php");
            }
        ?>
    </head>
    <body>
        <div class="navbar">
            <div class="navbarInner">
                <div style="display:flex;">
                    <a href="post.php"      class="headerBtn headerBtnInactive" style="width:20%;">Post</a>
                    <a href="feed.php"      class="headerBtn headerBtnInactive" style="width:20%;" id="feedBtn">Feed</a>
                    <a href="profile.php"   class="headerBtn" style="width:20%;">Profile</a>
                    <a href="settings.php"  class="headerBtn headerBtnInactive" style="width:20%;">Settings</a>
                    <a class="headerBtn headerBtnInactive logout" style="width:20%;" href="PHP/logout.php" onclick="return confirm('Are you sure you want to log out');">Logout</a>
                </div>
            </div>
        </div>
        <div class="bodyCard" style="height:auto;min-height:80vh;width:1200px;">
            <div>
                <div id="settingsComp" style="height:100%;width:100%;">
                    <div style="text-align:center;height:100%;display:flex;">
                        <form style="margin:auto;margin-top:20px;" action="PHP/editSettings.php" method="POST" enctype="multipart/form-data">
                            <h3>Username</h3>
                            <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>"></input>
                            <h3>Bio</h3>
                            <textarea name="bio"><?php echo $_SESSION["bio"]; ?></textarea>    
                            <br><br>
                            <input type="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footerInner">
                <?php 
                    echo "<p style='color:white;font-weight:lighter;'>Made with ❤️ by TREDX </p>";
                    echo "<p style='color:white;font-weight:lighter;'>Copyright © ".date("Y")."</p>";
                ?>
            </div>
        </div>
    </body>
</html>