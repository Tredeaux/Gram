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

    $bio = $_POST["bio"];
    
    $target_dir = '../uploads/'.$_SESSION["id"]."/";
  
    $_FILES["file"]["name"] = preg_replace('/\s+/', '_', basename($_FILES["file"]["name"]));

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (basename($_FILES["file"]["name"])) {
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        try {
            $stmt = $conn->prepare("INSERT INTO feed (user_id, picture, bio) VALUES (:id, :pic, :bio)"); 
            $stmt->execute([":pic" => basename($_FILES["file"]["name"]), ":id" => $_SESSION['id'], ":bio" => $bio]);
        } catch(PDOException $e) {

        }
    }
    header("Location: ../profile.php");
?>

