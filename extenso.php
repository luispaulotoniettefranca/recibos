<?php
function extenso($valor, $maiusculo = 0): string
{
    if (strpos($valor, ",") > 0) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
    }
    $singulares = [
        "centavo",
        "real",
        "mil",
        "milhão",
        "bilhão",
        "trilhão",
        "quatrilhão"
    ];

    $plurais = [
        "centavos",
        "reais",
        "mil",
        "milhões",
        "bilhões",
        "trilhões",
        "quatrilhões"
    ];

    $centenas = [
        "",
        "cem",
        "duzentos",
        "trezentos",
        "quatrocentos",
        "quinhentos",
        "seiscentos",
        "setecentos",
        "oitocentos",
        "novecentos"
    ];

    $dezenas = [
        "",
        "dez",
        "vinte",
        "trinta",
        "quarenta",
        "cinquenta",
        "sessenta",
        "setenta",
        "oitenta",
        "noventa"
    ];

    $excecoes = [
        "dez",
        "onze",
        "doze",
        "treze",
        "quatorze",
        "quinze",
        "dezesseis",
        "dezessete",
        "dezoito",
        "dezenove"
    ];

    $unidades = [
        "",
        "um",
        "dois",
        "três",
        "quatro",
        "cinco",
        "seis",
        "sete",
        "oito",
        "nove"
    ];

    $milhares = 0;

    $valor = number_format($valor, 2, ".", ".");
    $partes = explode(".", $valor);
    $quantidadePartes = count($partes);

    for ($i = 0; $i < $quantidadePartes; $i++)
        for ($ii = strlen($partes[$i]); $ii < 3; $ii++)
            $partes[$i] = "0" . $partes[$i];

    $fim = $quantidadePartes - ($partes[$quantidadePartes - 1] > 0 ? 1 : 2);
    $retorno = '';

    for ($i = 0; $i < $quantidadePartes; $i++) {
        $valor = $partes[$i];
        $retornoCentena = (($valor > 100) && ($valor < 200)) ? "cento" : $centenas[$valor[0]];
        $retornoDezena = ($valor[1] < 2) ? "" : $dezenas[$valor[1]];
        $retornoUnidade = ($valor > 0) ? (($valor[1] == 1) ? $excecoes[$valor[2]] : $unidades[$valor[2]]) : "";

        $resultado = $retornoCentena .
            (($retornoCentena && ($retornoDezena || $retornoUnidade)) ? " e " : "") .
            $retornoDezena .
            (($retornoDezena && $retornoUnidade) ? " e " : "") .
            $retornoUnidade;
        $etapa = $quantidadePartes - 1 - $i;
        $resultado .= $resultado ? " " . ($valor > 1 ? $plurais[$etapa] : $singulares[$etapa]) : "";

        if ($valor == "000")
            $milhares++;
        elseif ($milhares > 0)
            $milhares--;
        if (($etapa == 1) && ($milhares > 0) && ($partes[0] > 0))
            $resultado .= ( ($milhares > 1) ? " de " : "") . $plurais[$etapa];
        if ($resultado)
            $retorno = $retorno . ((($i > 0) && ($i <= $fim) &&
                    ($partes[0] > 0) && ($milhares < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $resultado;
    }

    if (!$maiusculo) {
        return trim($retorno ?: "zero");
    } elseif ($maiusculo == "2") {
        return trim(strtoupper($retorno) ? strtoupper(strtoupper($retorno)) : "Zero");
    } else {
        return trim(ucwords($retorno) ?: "Zero");
    }
}