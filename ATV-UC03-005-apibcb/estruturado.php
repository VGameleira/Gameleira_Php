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