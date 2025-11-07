<?php

function calcular($notasArray)
{
    return array_sum($notasArray) / count($notasArray);
}

function valMedia($media)
{
    return $media >= 7 ? true : false;
}

function mostrarMensagem(string $mensagem): string
{
    return $mensagem;
}

function mostrarResultado(bool $resultado): string
{
    return $resultado ? "Parabéns, você foi aprovado!" : "Infelizmente, você foi reprovado.";
}

function mostrarResultadoFinal($mensagem, $resultado): string
{
    return "<p>{$mensagem}</p><p id='" . ($resultado ? "aprovado" : "reprovado") . "'>" . mostrarResultado($resultado) . "</p>";
}




// mostrar hora de atual com function exibir()
function horas(){
    date_default_timezone_set("America/Sao_Paulo");
    $hj = date("h:i:sa");
    $hj2 = date("Y-m-d",time());
    $diaHora = "{$hj2} <br><br> {$hj}";
    return $diaHora;
}
 
function validarEntrada($nome, $notas) {
    if (isset($nome) && !empty($nome) && is_string($nome) && isset($notas) && is_array($notas) && count($notas) > 0) {
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

$nome = isset($_GET['nome']) ? trim($_GET['nome']) : '';
$notas = isset($_GET['notas']) ? $_GET['notas'] : [];

if (validarEntrada($nome, $notas)) {
    $media = calcular($notas);
    $result = valMedia($media);
} else {
    header("Location: ../index.html");
    exit();
}

$data = horas();

mostrarMensagem(mensagem: "Olá, {$nome}! Sua média é: {$media}");

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

        <?= mostrarResultadoFinal(mostrarMensagem(mensagem: "Olá, {$nome}! Sua média é: {$media}"), $result) ?>
        <p>Hoje é dia <?= $data ?></p>
    </main>
</body>

</html>