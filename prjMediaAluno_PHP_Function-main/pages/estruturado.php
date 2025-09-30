<?php
$nome = trim($_GET['nome']);
$notas = $_GET['notas'];

$media = array_sum($notas) / count($notas);

function calcularMedia(array $notas) {
    return array_sum($notas) / count($notas);
}

function MensagemBoasVindas(string $nome, float $media): string {
    return "Olá, {$nome}! Sua média é: {$media}";
}

function MensagemResultado(float $media): string {
    if ($media >= 7) {
        return "Parabéns, você foi aprovado!";
    } else {
        return "Infelizmente, você foi reprovado.";
    }
}

