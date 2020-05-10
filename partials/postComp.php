<div id="postComp" style="height:100%;width:100%;display:none;">
    <div style="text-align:center;height:100%;display:flex;">
        <form style="margin:auto;margin-top:20px;" action="PHP/upload_post.php" method="POST" enctype="multipart/form-data">
            <h3>Post</h3>
            <input  style="margin-left:70px;" type="file" name="file" id="fileToUpload" >
            <h3>Bio</h3>
            <textarea name="bio"></textarea>   
            <br><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
</div>