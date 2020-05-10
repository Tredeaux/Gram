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
    $_FILES["file"]["name"] = preg_replace('/\s+/', '_', basename($_FILES["file"]["name"]));
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (basename($_FILES["file"]["name"])) {
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        try {
            $stmt = $conn->prepare("UPDATE userdata SET picture = :pic  WHERE id = :id"); 
            $stmt->execute([":pic" => basename($_FILES["file"]["name"]), ":id" => $_SESSION['id']]);
            $_SESSION["picture"] = basename($_FILES["file"]["name"]);
        } catch(PDOException $e) {
        }
    }
    header("Location: ../profile.php");
?>