<div id="feedComp" style="text-align:center;width:100%;display:none;">    
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

            echo "<div style='display:flex;'>";
            for ($i = 0; $i < $stmt->rowCount(); $i++) {

                try {
                    $stmt2 = $conn->prepare("SELECT * FROM userdata WHERE id = :id"); 
                    $stmt2->execute([":id" =>$result[$i]["user_id"]]);
                    $user = $stmt2->fetch(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                    echo "Error: SQL didnt execute";
                }

                $image = "uploads/".$result[$i]["user_id"]."/".$result[$i]["picture"];

                if ($i%4 == 0) {
                    echo "</div><br>";
                    echo "<div style='display:flex;'>";
                }

                echo "<div class='imgDiv' onclick='modalSet(`F".$result[$i]["id"]."`)' style='height:200px;width:200px;border-radius:5px;background:url(".$image.") no-repeat center;background-size:cover;'>
                        <div class='overlay' style='width:200px;height:200px;margin-top:0px;border-radius:5px;'>
                            <p style='color:white;line-height:165px;'>Change Picture</p>
                        </div>
                      </div>";
                      
                echo "<div id='modalF".$result[$i]["id"]."' class='modal'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <span onclick='modalClose(`F".$result[$i]["id"]."`)' class='close'>&times;</span>            
                            <br>
                            <div style='width:100%;text-align:center;'>
                                <h3 style='margin-left:15px;margin-top:-10px;font-size:25px;'>".$user["username"]."</h3>
                                <p style='margin-top:-15px;'>".$result[$i]["creation_date"]."</p>
                            </div>
                          </div>
                          <div class='modal-body' style='padding:15px;text-align:center;'>
                            <br>
                            <div style='margin:auto;width:600px;height:600px;'>
                                <img class='imageLarge' src='../uploads/".$user["id"]."/".$result[$i]["picture"]."'>
                            </div>
                            <br>
                            <div style='margin:auto;width:600px;height:150px;border:5px solid var(--color-1);'>
                                <p> ".$result[$i]["bio"]."</p>
                            </div>
                          </div>
                          <br>        
                        </div>                  
                      </div>";
            }
            echo "</div><br>";
        } catch(PDOException $e) {
            echo "Error: SQL didnt execute";
        }
    ?>

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