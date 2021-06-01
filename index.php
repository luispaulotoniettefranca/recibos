<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTAGEM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@forevolve/bootstrap-dark@1.0.0/dist/css/bootstrap-dark.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body class="container mt-5">
<table class="table table-bordered">
    <thead>
    <tr>
        <td colspan="2" class="text-left"><a href="form.php"><h4>CADASTRAR NOVO RECIBO</h4></a></td>
        <td colspan="2" class="text-center"><a target="_blank" href="template.php"><h4>IMPRIMIR RECIBOS</h4></a></td>
        <td colspan="1" class="text-center"><a href="auth.php"><h6>LOGOUT</h6></a></td>
    </tr>
    <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Importância</th>
        <th scope="col">Serviço</th>
        <th scope="col" class="text-center">EDITAR</th>
        <th scope="col" class="text-center">EXCLUIR</th>
    </tr>
    </thead>
    <tbody>
<?php
session_start();
if(!$_SESSION["auth"]) header("Location: login.php");
require "db.php";
/**
 * @var PDO $pdo
 */
$stmt = $pdo->prepare("SELECT * FROM recibos");
$stmt->execute();
$recibos = $stmt->fetchAll();
foreach ($recibos as $recibo) {
    echo <<<TPL
        <tr>
          <td>{$recibo->costumer}</td>
          <td>R$ {$recibo->amount}</td>
          <td>{$recibo->job}</td>
          <td class="text-center"><a href="form.php?id={$recibo->id}"><span><i class="fas fa-edit"></i></span></a></td>
          <td class="text-center"><a href="delete.php?id={$recibo->id}"><span style="color: red"><i class="fas fa-trash-alt"></span></i></a></td>
        </tr>
TPL;
}
?>
    </tbody>
</table>
</body>
</html>