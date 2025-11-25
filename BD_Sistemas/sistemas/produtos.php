<?php
require_once '../conexoes/conex_produtos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $descricao = $_POST["descricao"];

    if (!empty($nome) && !empty($preco) && !empty($quantidade)) {
        $sql = "INSERT INTO produtos (nome, preco, quantidade, descricao)
                VALUES (:nome, :preco, :quantidade, :descricao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":descricao", $descricao);

        if ($stmt->execute()) {
            $mensagem = "Produto cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar produto.";
        }
    } else {
        $mensagem = "Preencha os campos obrigatórios!";
    }
}

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Produtos - Sistema</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>📦 Sistema de Produtos</h1>
			<p><a href="index.html">Voltar ao menu</a></p>
		</header>

		<div class="system-container">
			<form id="formProdutos">
				<div class="form-grid">
					<div class="form-group">
						<label>Nome do Produto *</label>
						<input type="text" name="nome" required placeholder="Ex: Notebook Dell">
					</div>
					<div class="form-group">
						<label>Preço (R$) *</label>
						<input type="number" name="preco" step="0.01" min="0" required placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Quantidade *</label>
						<input type="number" name="quantidade" min="0" required placeholder="0">
					</div>
					<div class="form-group" style="grid-column: 1 / -1;">
						<label>Descrição</label>
						<textarea name="descricao" placeholder="Descreva as características do produto..."></textarea>
					</div>
				</div>
				<button type="submit" class="btn-submit">✅ Cadastrar Produto</button>
			</form>

			<div id="alertProdutos"></div>

			<div class="table-container">
				<h3 style="margin-bottom:20px;color:#667eea;">📋 Produtos Cadastrados</h3>
				<div class="stats">
					<div class="stat-card">
						<h3 id="totalProdutos">0</h3>
						<p>Total de Produtos</p>
					</div>
					<div class="stat-card">
						<h3 id="totalEstoque">0</h3>
						<p>Itens em Estoque</p>
					</div>
				</div>
				<div id="tabelaProdutos"></div>
			</div>
		</div>
	</div>

	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/produtos.js"></script>
</body>
</html>