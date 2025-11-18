<?php
require_once "conexao.php";
$sql = "SELECT * FROM sistema_imoveis ORDER BY id DESC";
$stmt = $pdo->query($sql);
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Imobiliária - Página Inicial</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Imóveis Disponíveis</h1>
    <div class="imoveis-container">
        <?php foreach ($imoveis as $imovel) { ?>
            <div class="imovel-card">
                <h2><?= htmlspecialchars($imovel['tipo']) ?> - <?= htmlspecialchars($imovel['finalidade']) ?></h2>
                <p><strong>Localização:</strong> <?= htmlspecialchars($imovel['localizacao']) ?></p>
                <p><strong>Preço:</strong> R$ <?= htmlspecialchars($imovel['preco']) ?></p>
                <p><?= nl2br(htmlspecialchars($imovel['descricao'])) ?></p>
            </div>
        <?php } ?>
    </div>
</body>

</html>