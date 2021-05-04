<?php
require "db.php";
if ($_POST["id"] > 0) {
    $query = "UPDATE recibos SET costumer = ?, amount = ?, job = ?  WHERE id = ?";
    $params = [$_POST["costumer"], $_POST["amount"], $_POST["job"], $_POST["id"]];
} else {
    $query = "INSERT INTO recibos (costumer, amount, job) VALUES (?, ?, ?)";
    $params = [$_POST["costumer"], $_POST["amount"], $_POST["job"]];
}
$stmt = $pdo->prepare($query);
$stmt->execute($params);
header("Location: index.php");