<?php
require_once 'api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$valor = floatval($_POST['valor']);
$moeda = strtoupper($_POST['moeda']);
$resultado = converterBRL($valor, $moeda);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Conversão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>💱 Resultado da Conversão</h1>

    <?php if (isset($resultado['erro'])): ?>
        <p class="erro"><?= htmlspecialchars($resultado['erro']) ?></p>
    <?php else: ?>
        <p>
            💰 <strong>R$ <?= number_format($resultado['valor_brl'], 2, ',', '.') ?></strong> =
            <strong><?= number_format($resultado['valor_convertido'], 2, ',', '.') ?> <?= $resultado['moeda'] ?></strong>
        </p>
        <small>Cotação atual: <?= number_format($resultado['cotacao'], 4, ',', '.') ?></small>
    <?php endif; ?>

    <br><br>
    <a href="index.html" class="voltar">⬅ Voltar</a>
</div>
</body>
</html>
