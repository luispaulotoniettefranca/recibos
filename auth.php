<?php
session_start();
if($_SESSION["auth"]) {
    session_destroy();
    header("Location: login.php");
} else {
    require "db.php";
    /**
     * @var PDO $pdo
     */
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
    $stmt->execute([$_POST["login"], $_POST["password"]]);
    $user = $stmt->fetch();
    if ($user) {
        session_start();
        $_SESSION["auth"] = true;
        header("Location: index.php");
    } else {
        header("Location: login.php?error='Access Denied'");
    }
}

?>