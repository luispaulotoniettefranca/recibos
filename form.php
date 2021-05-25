<?php
session_start();
if(!$_SESSION["auth"]) header("Location: login.php");
require "db.php";
$recibo = (object)array(
    "id" => 0,
    "costumer" => "",
    "amount" => "",
    "job" => ""
);
if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $stmt = $pdo->prepare("SELECT * FROM recibos WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $recibo = $stmt->fetch();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TONIETTE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="container mt-5">
<form action="save.php" method="post">
    <input type="hidden" name="id" value="<?= $recibo->id ?>">
    <div class="form-group m-2">
        <label for="costumer">RECEBEMOS DE:</label>
        <input type="text" class="form-control" id="costumer" name="costumer" value="<?= $recibo->costumer ?>">
    </div>
    <div class="form-group m-2">
        <label for="amount">A IMPORTÂNCIA DE:</label>
        <input type="text" class="form-control" id="amount" name="amount" value="<?= $recibo->amount ?>">
    </div>
    <div class="form-group m-2">
        <label for="job">REFERENTE A:</label>
        <input type="text" class="form-control" id="job" name="job" value="<?= $recibo->job ?>">
    </div>
    <button type="submit" class="btn btn-primary mt-3">SALVAR</button>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$('#amount').mask('#.##0,00', {reverse: true});
</script>
</body>
</html>