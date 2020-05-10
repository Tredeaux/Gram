<?php
    require_once '../SQL/connect.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {

    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $target_dir = '../uploads/'.$_SESSION["id"]."/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // if ($_FILES["file"]["size"] > 500000) {
    //     $_SESSION["file_size"] = 1;
    // } else {
    //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //         $_SESSION["file_type"] = 1;
    //     } else {
            if (basename($_FILES["file"]["name"])) {
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                try {
                    $stmt = $conn->prepare("UPDATE userdata SET picture = :pic  WHERE id = :id"); 
                    $stmt->execute([":pic" => basename($_FILES["file"]["name"]), ":id" => $_SESSION['id']]);
                    $_SESSION["picture"] =  basename($_FILES["file"]["name"]);
                } catch(PDOException $e) {
        
                }
            }
    //     }
    // }

    $bio = $_POST["bio"];
    if ($bio) {
        try {
            $stmt = $conn->prepare("UPDATE userdata SET bio = :n  WHERE id = :id"); 
            $stmt->execute([":n" => $bio, ":id" => $_SESSION['id']]);
            $_SESSION["bio"] = $bio;
        } catch(PDOException $e) {
            //echo "Error: " . $e->getMessage();
        } 
    }

    $username = $_POST["username"];
    if ($_POST["username"]) {
        try {
            $stmt = $conn->prepare("UPDATE userdata SET username = :n  WHERE id = :id"); 
            $stmt->execute([":n" => $username, ":id" => $_SESSION['id']]);
            $_SESSION["username"] = $username;
        } catch(PDOException $e) {
            //echo "Error: " . $e->getMessage();
        } 
    }

    header("Location: ../settings.php");
?>