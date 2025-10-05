<?php


// ===============================
// 1️⃣ Função: Valida entradas
// ===============================
function validarEntradas($valor, $moeda) {
    if (!is_numeric($valor) || $valor <= 0) {
        exibirMensagem("Valor inválido. Digite um número maior que zero.");
        exit;
    }

    $moedasSuportadas = ['USD', 'EUR', 'GBP', 'ARS'];
    if (!in_array(strtoupper($moeda), $moedasSuportadas)) {
        exibirMensagem("Moeda não suportada.");
        exit;
    }
}

// ===============================
// 2️⃣ Função: Exibe mensagens HTML
// ===============================
function exibirMensagem($mensagem) {
    echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <title>Erro</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class='container'>
            <h1>Aviso</h1>
            <p>$mensagem</p>
            <a href='index.html' class='voltar'>← Voltar</a>
        </div>
    </body>
    </html>";
}


// ===============================
// 3️⃣ Função: Converte para Dólar
// ===============================
function converterDolar($valor) {
    $cotacao = obterCotacao('USD');
    return $valor / $cotacao;
}

// ===============================
// 4️⃣ Função: Converte para Euro
// ===============================
function converterEuro($valor) {
    $cotacao = obterCotacao('EUR');
    return $valor / $cotacao;
}


// ===============================
// 5️⃣ Função: Converte para moeda personalizada
// ===============================
function converterMoeda($valor, $moeda) {
    $cotacao = obterCotacao($moeda);
    return $valor / $cotacao;
}

// ===============================
// 6️⃣ Função: Consulta a API do Banco Central
// ===============================
function obterCotacao($moeda) {
    $codigos = [
    'USD' => 1,
    'EUR' => 21619,
    'GBP' => 21623,
    'ARS' => 21627,
    'JPY' => 21621,
    'CAD' => 21620,
    'AUD' => 21622,
    'CHF' => 21618,
    'CNY' => 21625,
    'CLP' => 21624,
    'MXN' => 21626,
    'ZAR' => 21628,
    'SEK' => 21629,
    'NOK' => 21630,
    'DKK' => 21631,
    'KRW' => 21632,
    'INR' => 21633
    ];

    if (!isset($codigos[$moeda])) {
        exibirMensagem("Código da moeda não encontrado.");
        exit;
    }
    // link da api https://api.bcb.gov.br/dados/serie/bcdata.sgs.1/dados/ultimos/1?formato=json
    // USD = 1, EUR = 21619, GBP = 21623, ARS = 21627 ...
    $codigoSerie = $codigos[$moeda];
    $url = "https://api.bcb.gov.br/dados/serie/bcdata.sgs.$codigoSerie/dados/ultimos/1?formato=json";

    $json = @file_get_contents($url);
    if (!$json) {
        exibirMensagem("Erro ao consultar a API do Banco Central.");
        exit;
    }

    $dados = json_decode($json, true);
    return floatval(str_replace(',', '.', $dados[0]['valor']));
}

// ===============================
// 7️⃣ Execução principal
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor = floatval($_POST['valor']);
    $moeda = strtoupper($_POST['moeda']);

    validarEntradas($valor, $moeda);

    $resultado = converterMoeda($valor, $moeda);
    $cotacao = obterCotacao($moeda);

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