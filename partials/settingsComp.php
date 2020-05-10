<div id="settingsComp" style="height:100%;width:100%;display:none;">
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