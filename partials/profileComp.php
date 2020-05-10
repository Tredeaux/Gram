<div id="profileComp" style="height:100%;width:100%;display:block;">
    <div style="margin:auto;width:800px;height:300px;display:flex;">
        <div style="text-align:center;width:50%;"> 
            <br><br>
            <div style="width:250px;margin:auto;">
                <form id="updateProfilePic" action="PHP/update_profile_picture.php" method="POST" enctype="multipart/form-data"> 
                    <label for="file-input">
                        <?php                            
                            if (!isset($_SESSION["picture"]) or ($_SESSION["picture"] == "")) { 
                                $image = '"uploads/user.png"';
                            } else {
                                $image = '"uploads/'.$_SESSION["id"].'/'.$_SESSION["picture"].'"';
                            }
                            echo "<div class='imgDiv' style='border-radius:100%;background:url(".$image.") no-repeat center;background-size:cover;'>
                                    <div class='overlay' style='width:220px;height:220px;margin-top:0px;border-radius:100%;'>
                                        <p style='color:white;line-height:190px;'>Change Picture</p>
                                    </div>
                                  </div>";
                        ?>
                    </label>
                    <input onchange="document.getElementById('updateProfilePic').submit();" style="display:none;" type="file" name="file" id="file-input" >                               
                </form>
            </div>
        </div>
        <div style="width:50%;">
            <br>
            <div style="padding-top:12px;text-align:left;">
                <?php
                    echo "<h1 style='font-weight:bolder;margin-bottom:0px;margin-bottom:3px;'>" . $_SESSION["username"] . "</h1>";
                    echo "<div style='font-size:20px;display:flex;'><p style='margin-top:6px;margin-bottom:6px;font-weight:600;margin-right:5px;'>";
                    try {
                        $stmt = $conn->prepare("SELECT * FROM feed ORDER BY id DESC LIMIT 20"); 
                        $stmt->execute();
                        echo $stmt->rowcount();
                    } catch(PDOException $e) {
                        echo "#";
                    }
                    echo "</p><p style='font-weight:400;margin-top:6px;margin-bottom:6px;'>Posts</p></div>";
                ?>
            </div>
            <div style="width:400px;height:100px;">
                <div class="bioCard">
                    <?php
                        echo "<p style='font-weight:400;'>".$_SESSION["bio"]."</p>";
                    ?>
                </div>
                <div>
                    <?php
                        echo "<p style='font-size:13px;float:left;margin-top:0px;;font-weight:400;'>".substr($_SESSION["cr_date"],0,10)."</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align:center;width:100%;">
        <div style="margin:auto;border:1px solid var(--color-4);width:95%;background-color:var(--color-2);">
        </div>
            <br>
            <div style="margin:auto;width:1130px;">
            <?php
                try {
                    $stmt = $conn->prepare("SELECT * FROM feed ORDER BY id DESC LIMIT 20"); 
                    $stmt->execute();
                    $result = array();
                    if ($stmt->execute()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $result[] = $row;
                        }
                    }                                 
                
                    echo "<div class='cardRow'>";
                    for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    
                        try {
                            $stmt2 = $conn->prepare("SELECT * FROM userdata WHERE id = :id"); 
                            $stmt2->execute([":id" =>$_SESSION["id"]]);
                            $user = $stmt2->fetch(PDO::FETCH_ASSOC);
                        } catch(PDOException $e) {
                            echo "Error: SQL didnt execute";
                        }
                    
                        $image = "uploads/".$result[$i]["user_id"]."/".$result[$i]["picture"];
                    
                        if ($i%4 == 0) {
                            echo "</div>";
                            echo "<div class='cardRow'>";
                        }
                    
                        echo "<div class='imgDiv' onclick='modalSet(`F".$result[$i]["id"]."`)' style='height:270px;width:270px;border-radius:5px;background:url(".$image.") no-repeat center;background-size:cover;'>
                                <div class='overlay' style='margin-left:-2px;margin-top:-4px;width:270px;height:270px;margin-top:0px;border-radius:5px;'>
                                    <p style='color:white;line-height:230px;'>Change Picture</p>
                                </div>
                              </div>

                              <div id='modalF".$result[$i]["id"]."' class='modal'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <span onclick='modalClose(`F".$result[$i]["id"]."`)' class='close'>&times;</span>            
                                    <br>
                                    <div style='width:100%;text-align:center;'>
                                    <br>
                                        <h3 style='margin-bottom:0px;margin-left:15px;margin-top:-10px;font-size:35px;'>".$user["username"]."</h3>                                       
                                    </div>
                                  </div>
                                  <div class='modal-body' style='text-align:center;'>
                                    <br>
                                    <div style='margin:auto;width:600px;height:600px;'>
                                        <img class='imageLarge' src='../uploads/".$user["id"]."/".$result[$i]["picture"]."'>
                                    </div>
                                    <br>
                                    <div style='margin:auto;width:600px;'>
                                        <p style='color:var(--color-4);text-align:left;margin-left:10px;margin-top:-15px;margin-bottom:3px;'>Posted on: ".$result[$i]["creation_date"]."</p>    
                                        <div style='margin:auto;width:600px;height:auto;border:1px solid var(--color-3);border-radius:5px;'>
                                            <p> ".$result[$i]["bio"]."</p>
                                        </div>
                                    </div>
                                  </div>
                                  <br>
                                </div>
                              </div>";
                    }
                    echo "</div>";
                } catch(PDOException $e) {
                    echo "Error: SQL didnt execute";
                }
            ?>
            </div>

            <script>
                function modalSet(id) {
                    var modal = document.getElementById("modal"+id); 
                    modal.style.display = "block";
                }
            
                function modalClose(id) {
                    var modal = document.getElementById("modal"+id); 
                    modal.style.display = "none";
                }
            </script>
    </div>
</div>