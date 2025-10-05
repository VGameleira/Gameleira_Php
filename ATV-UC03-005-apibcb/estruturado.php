<?php


// ===============================
// 1 Função: Valida entradas
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
// 2 Função: Exibe mensagens HTML
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
        'ARS' => 21627
    ];

    if (!isset($codigos[$moeda])) {
        exibirMensagem("Código da moeda não encontrado.");
        exit;
    }

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

