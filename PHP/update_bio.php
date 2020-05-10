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
    if ($bio) {
        try {
            $stmt = $conn->prepare("UPDATE userdata SET bio = :n  WHERE id = :id"); 
            $stmt->execute([":n" => $bio, ":id" => $_SESSION['id']]);
            $_SESSION["bio"] = $bio;
        } catch(PDOException $e) {
            //echo "Error: " . $e->getMessage();
        } 
    }
    header("Location: ../profile.php");

?>