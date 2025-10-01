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

// function validarEntrada deve ter as seguintes condições:
// - nome deve estar definido e não ser vazio
// - notas deve estar definido, ser um array e ter pelo menos um elemento
// - itens do array notas devem ser numéricos e entre 0 e 10
// - array não pode ser vazio
// - se alguma dessas condições não for atendida, redirecionar para index.html


function validarEntrada($nome, $notas) {
    if (isset($nome) && !empty($nome) && isset($notas) && is_array($notas) && count($notas) > 0) {
        foreach ($notas as $nota) {
            if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}
