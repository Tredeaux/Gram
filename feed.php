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
            <div><br>
                <div style="padding-bottom:10px;padding-top:10px;border-radius:5px;border:1px solid var(--color-4);margin:auto;text-align:center;width:1169px;">                        
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