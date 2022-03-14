<?php
session_start();
if($_SESSION["auth"]) {
    session_destroy();
    header("Location: login.php");
} else {
    require "db.php";

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$_POST["login"]]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST["password"], $user->password)) {
        $_SESSION["auth"] = true;
        header("Location: index.php");
    } else {
        header("Location: login.php?error='Access Denied'");
    }
}