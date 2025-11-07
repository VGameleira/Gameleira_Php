<?php
function validarEntrada($produto, $filial1, $filial2, $filial3) {
    if (empty($produto) || !is_string($produto)) {
        return "Nome do produto inválido.";
    }
    if (!is_numeric($filial1) || $filial1 < 0 || !is_numeric($filial2) || $filial2 < 0 || !is_numeric($filial3) || $filial3 < 0) {
        return "Quantidades de estoque inválidas.";
    }
    return true;
}

function calcularEstoqueTotal($filial1, $filial2, $filial3) {
    return $filial1 + $filial2 + $filial3;
}

function verificarEstoqueBaixo($produto, $filial1, $filial2, $filial3) {
    $filiaisBaixas = [];
    if ($filial1 < 30) $filiaisBaixas[] = "Filial 1";
    if ($filial2 < 30) $filiaisBaixas[] = "Filial 2";
    if ($filial3 < 30) $filiaisBaixas[] = "Filial 3";

    if (!empty($filiaisBaixas)) {
        return "Produto: $produto - Estoque Baixo nas " . implode(", ", $filiaisBaixas);
    }
    return null;
}

// Processamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST["produto"];
    $filial1 = (int)$_POST["filial1"];
    $filial2 = (int)$_POST["filial2"];
    $filial3 = (int)$_POST["filial3"];

    $validacao = validarEntrada($produto, $filial1, $filial2, $filial3);

    if ($validacao === true) {
        $total = calcularEstoqueTotal($filial1, $filial2, $filial3);
        $estoqueBaixo = verificarEstoqueBaixo($produto, $filial1, $filial2, $filial3);

        echo "<h1>Resultado do Cadastro</h1>";
        echo "<p>Produto: $produto</p>";
        echo "<p>Filial 1: $filial1 unidades</p>";
        echo "<p>Filial 2: $filial2 unidades</p>";
        echo "<p>Filial 3: $filial3 unidades</p>";
        echo "<p><strong>Estoque Total:</strong> $total unidades</p>";

        if ($estoqueBaixo) {
            echo "<p style='color:red;'>$estoqueBaixo</p>";
        } else {
            echo "<p>Estoque adequado em todas as filiais.</p>";
        }
    } else {
        echo "<p style='color:red;'>Erro: $validacao</p>";
    }
}



$produtos = [
    "Juca Cola 2L" => ['filial1' => 100, 'filial2' => 40, 'filial3' => 21],
    "Juca Cola 1L" => ['filial1' => 25, 'filial2' => 50, 'filial3' => 10],
    "Produto B" => ['filial1' => 60, 'filial2' => 20, 'filial3' => 5],
    "Produto C" => ['filial1' => 80, 'filial2' => 90, 'filial3' => 100],
    "Produto D" => ['filial1' => 15, 'filial2' => 30, 'filial3' => 45],
];

?>

