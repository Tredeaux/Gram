<?php
    require "../SQL/connect.php";

    $email = strtolower(trim($_POST["email"]));
    $password = $_POST["password"];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM userdata WHERE email = :email"); 
        $stmt->execute([":email" => $email]);
        
        if ($stmt->rowcount() > 0) {
            $result =  $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $result["password"])) {
                $_SESSION["username"] = $result["username"];
                $_SESSION["id"] = $result["id"];
                $_SESSION["email"] = $result["email"];
                $_SESSION["picture"] = $result["picture"];
                $_SESSION["bio"] = $result["bio"];
                $_SESSION["cr_date"] = $result["cr_date"];
                header("Location: ../profile.php");
            } else {
                $_SESSION["error"] = "Passwords don't Match";
                header("Location: ../index.php");
            }
        }   
        else {
            $_SESSION["error"] = "Account does not exist";
            header("Location: ../index.php");
        }
    } catch(PDOException $e) {
        $_SESSION["error"] = "Error registering account";
        header("Location: ../index.php");
    }
?>