<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor = floatval($_POST['valor']);
    $moeda = strtoupper($_POST['moeda']);

    // Lista de códigos das séries do Banco Central
    $codigos = [
        'USD' => 1,
        'EUR' => 21619,
        'GBP' => 21623,
        'ARS' => 21627
    ];

    if (!isset($codigos[$moeda])) {
        echo "Moeda não suportada.";
        exit;
    }

    $codigoSerie = $codigos[$moeda];
    $url = "https://api.bcb.gov.br/dados/serie/bcdata.sgs.$codigoSerie/dados/ultimos/1?formato=json";

    $json = @file_get_contents($url);
    if (!$json) {
        echo "Erro ao consultar o Banco Central.";
        exit;
    }

    $dados = json_decode($json, true);
    $cotacao = floatval(str_replace(',', '.', $dados[0]['valor']));
    $resultado = $valor / $cotacao;

    // Exibe o resultado com HTML simples
    echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <title>Resultado da Conversão</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class='container'>
            <h1>Resultado</h1>
            <p>R$ " . number_format($valor, 2, ',', '.') . " equivalem a:</p>
            <h2>" . number_format($resultado, 2, ',', '.') . " $moeda</h2>
            <p>Cotação atual: R$ " . number_format($cotacao, 4, ',', '.') . "</p>
            <a href='index.html' class='voltar'>← Voltar</a>
        </div>
    </body>
    </html>";
}
?>