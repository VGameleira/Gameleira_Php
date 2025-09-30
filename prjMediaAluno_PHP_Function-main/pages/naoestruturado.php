<?php

function calcularMedia(array $notas) {

    $resultado = array_sum($notas) / count($notas);
    return $resultado;
}

function verificarAprovacao($media){
    return $media>=7 ? "aprovado" : "reprovado";
}

$nome = trim($_GET['nome']);
$notas = $_GET['notas'];

// $media = array_sum($notas) / count($notas);

// $mensagemBoasVindas = "Olá, {$nome}! Sua média é: {$media}";
// if ($media >= 7) {
//     $mensagemResultado = "Parabéns, você foi aprovado!";
// } else {
//     $mensagemResultado =  "Infelizmente, você foi reprovado.";
// }




?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance do Aluno</title>
    <link rel="stylesheet" href="./../css/style.css">
</head>

<body>
    <main class="container">
        <h1>Performance do Aluno</h1>
        <p><?= $mensagemBoasVindas ?></p>
        <p id="<?= $media>=7 ? "aprovado" : "reprovado"; ?>"><?= $mensagemResultado ?></p>
    </main>
</body>

</html>