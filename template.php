<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IMPRIMIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        @media print {
            * {
                background:transparent !important;
                color:#000 !important;
                text-shadow:none !important;
                filter:none !important;
                -ms-filter:none !important;
            }
            #print {
                display: none;
            }
            body {
                margin:0;
                padding:0;
                line-height: 1.4em;
            }
        }
        @page {
            margin: 0.5cm;
        }
    </style>
</head>
<body style="max-width: 700px; margin: auto; zoom: 90%">
<input class="btn btn-primary mt-3" id="print" type="button" value="IMPRIMIR" onClick="window.print();"/>
<br>
<?php
require "extenso.php";
require "db.php";
/**
 * @var PDO $pdo
 */
$stmt = $pdo->prepare("SELECT * FROM recibos");
$stmt->execute();
$date = date('d/m/Y');
$recibos = $stmt->fetchAll();
$i = 1;
foreach ($recibos as $recibo) {
    $extenso = extenso($recibo->amount);
    echo <<<RECIBO
<div class="container-fluid border border-dark rounded m-3 p-4 pt-1">
    <div class="row mb-2 p-3 border-bottom">
        <div class="col-4 mt-4 ml-5 text-center">
            <h1 style="font-size: 64px;"><b>RECIBO</b></h1>
        </div>
        <div class="col-8">
            <div class="row" style="text-align: right">
                <div class="col-12">
                    Luís Paulo Toniette França
                </div>
                <div class="col-12">
                    CNPJ: 36.358.168/0001-10
                </div>
                <div class="col-12">
                    (43) 9.9672-3871
                </div>
                <div class="col-4" style="color: white">
                .
                </div>
                <div class="col-8 border rounded border-dark text-right">
                <h3>R$ {$recibo->amount}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-1">
        <p class="border-bottom">Recebemos de:  {$recibo->costumer} </p>
    </div>
    <div class="row mb-1">
        <p class="border-bottom">A importância de: {$extenso} </p>
    </div>
    <div class="row mb-1">
        <p class="border-bottom">Referente a:  {$recibo->job} </p>
    </div>
    <div class="row mt-2">
        <div class="col-4">
            <p class="border-bottom">Data:  {$date} </p>
        </div>
        <div class="col-8" style="text-align: right">
            Assinatura: ________________________________________
        </div>
    </div>
</div>
RECIBO;
    if ($i%3 == 0) {
        echo "<br><br><br><br>";
    }
    $i++;
}
?>
</body>
</html>