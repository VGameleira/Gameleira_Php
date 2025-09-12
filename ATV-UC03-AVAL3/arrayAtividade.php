<?php

// PARTE A - Manipulação de Arrays


// A1) Array inicial - pegando os 5 elementos do formulário
$arrayOriginal = $_POST['array_inicial'] ?? []; // Recebe array enviado pelo formulário

// A2) Elemento a adicionar na 3ª posição
$novoElemento = $_POST['novo_elemento'] ?? '';

// A2) Adicionar elemento na 3ª posição
$arrayComAdicao = $arrayOriginal;
if ($novoElemento) {
    array_splice($arrayComAdicao, 2, 0, $novoElemento); // Adiciona na posição 2 (3ª)
}

// A3) Remover o último elemento do array
$arrayComRemocao = $arrayComAdicao;
array_pop($arrayComRemocao); // Remove o último elemento

// A4) Transformar todos os elementos do array original em maiúsculas
$arrayMaiusculo = array_map('strtoupper', $arrayOriginal);



// PARTE B/C - Números

$resultadoNumeros = [];
$pares = 0;
$impares = 0;

// Recebe os 10 números do formulário
if (isset($_POST['numeros'])) {
    $numeros = array_map('intval', $_POST['numeros']); // Converte todos para inteiros
    $resultadoNumeros = $numeros;

    // Contar pares e ímpares
    foreach ($numeros as $n) {
        if ($n % 2 === 0) $pares++;
        else $impares++;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Resultados - Todas as Atividades</title>
<style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
    header { background: #3498db; color: white; padding: 20px; text-align: center; }
    main { max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #2c3e50; margin-top: 0; }
    .array-box, .resultado-box { background: #ecf0f1; border: 1px solid #ccc; padding: 10px; border-radius: 6px; font-family: monospace; white-space: pre-line; margin-bottom: 10px; }
    a { display: inline-block; margin-top: 10px; padding: 8px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; }
    a:hover { background: #2980b9; }
</style>
</head>
<body>

<header>
    <h1>Resultados das Atividades</h1>
</header>

<main>

<!-- PARTE A1: Array Original -->
<h2>A1) Array Original</h2>
<div class="array-box">
<?php
for ($i = 0; $i < count($arrayOriginal); $i++) {
    echo $arrayOriginal[$i] . "<br>";
}
?>
</div>

<!-- PARTE A2: Array após adicionar elemento na 3ª posição -->
<h2>A2) Array após adicionar elemento na 3ª posição</h2>
<div class="array-box">
<?php
for ($i = 0; $i < count($arrayComAdicao); $i++) {
    echo $arrayComAdicao[$i] . "<br>";
}
?>
</div>

<!-- PARTE A3: Array após remover o último elemento -->
<h2>A3) Array após remover o último elemento</h2>
<div class="array-box">
<?php
for ($i = 0; $i < count($arrayComRemocao); $i++) {
    echo $arrayComRemocao[$i] . "<br>";
}
?>
</div>

<!-- PARTE A4: Array em maiúsculas -->
<h2>A4) Array em maiúsculas</h2>
<div class="array-box">
<?php
for ($i = 0; $i < count($arrayMaiusculo); $i++) {
    echo $arrayMaiusculo[$i] . "<br>";
}
?>
</div>

<hr>

<!-- PARTE B: Exibir os números digitados -->
<h2>B) Números digitados</h2>
<div class="resultado-box">
<?php
for ($i = 0; $i < count($resultadoNumeros); $i++) {
    echo $resultadoNumeros[$i] . "<br>";
}
?>
</div>

<!-- PARTE C: Contagem de pares e ímpares -->
<h2>C) Contagem de Pares e Ímpares</h2>
<div class="resultado-box">
<?php
echo "<strong>Pares:</strong> $pares<br>";
echo "<strong>Ímpares:</strong> $impares<br>";
?>
</div>

<a href="index.html">Voltar ao formulário</a>

</main>
</body>
</html>
