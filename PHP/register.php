<?php

    require "../SQL/connect.php";

    $username = trim($_POST["username"]);
    $email = strtolower(trim($_POST["email"]));
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $stmt = $conn->prepare("SELECT * FROM userdata WHERE email = :email"); 
        $stmt->execute([":email" => $email]);
        
        if ($stmt->rowcount() > 0) {
            echo "Error: Email Exists";
        }   
        else if ($stmt->rowcount() == 0) {
            $stmt = $conn->prepare("INSERT INTO userdata (password, email, username) VALUES (:password, :email, :username)" );
            $stmt->execute([":password" => $password, ":email" => $email, ":username" => $username]);
            
            try {
                $stmt = $conn->prepare("SELECT * FROM userdata WHERE email = :email"); 
                $stmt->execute([":email" => $email]);
                $result =  $stmt->fetch(PDO::FETCH_ASSOC);
                mkdir("../uploads/".$result["id"]);
            } 
            catch(PDOException $e) {
                echo "Error: SQL didnt execute";
            }                


            header("Location: ../index.php");
        }
    } catch(PDOException $e) {
        echo "Error: SQL didnt execute";
    }

?>