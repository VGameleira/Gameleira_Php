<?php
require_once '../conexoes/conex_clientes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nome = $_POST["nome"];
	$endereco = $_POST["endereco"];
	$cidade = $_POST["cidade"];
	$bairro = $_POST["bairro"];
	$produto = $_POST["produto"];

	if (!empty($nome)) {
		$sql = "INSERT INTO clientes (nome, endereco, cidade, bairro, produto)
				VALUES (:nome, :endereco, :cidade, :bairro, :produto)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":nome", $nome);
		$stmt->bindParam(":endereco", $endereco);
		$stmt->bindParam(":cidade", $cidade);
		$stmt->bindParam(":bairro", $bairro);
		$stmt->bindParam(":produto", $produto);

		if ($stmt->execute()) {
			$mensagem = "Cliente cadastrado com sucesso!";
		} else {
			$mensagem = "Erro ao cadastrar cliente.";
		}
	} else {
		$mensagem = "Preencha os campos obrigatórios!";
	}
}
$sql = "SELECT * FROM clientes ORDER BY id DESC";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Clientes - Sistema</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>👥 Sistema de Clientes</h1>
			<p><a href="index.html">Voltar ao menu</a></p>
		</header>

		<div class="system-container">
			<form id="formClientes">
				<div class="form-grid">
					<div class="form-group">
						<label>Nome *</label>
						<input type="text" name="nome" required placeholder="Nome completo">
					</div>
					<div class="form-group">
						<label>Endereço</label>
						<input type="text" name="endereco" placeholder="Rua, número">
					</div>
					<div class="form-group">
						<label>Cidade</label>
						<input type="text" name="cidade" placeholder="Cidade">
					</div>
					<div class="form-group">
						<label>Bairro</label>
						<input type="text" name="bairro" placeholder="Bairro">
					</div>
					<div class="form-group">
						<label>Produto</label>
						<input type="text" name="produto" placeholder="Produto de interesse">
					</div>
				</div>
				<button type="submit" class="btn-submit">✅ Cadastrar Cliente</button>
			</form>

			<div id="alertClientes"></div>

			<div class="table-container">
				<h3 style="margin-bottom:20px;color:#667eea;">📋 Clientes Cadastrados</h3>
				<div class="stats">
					<div class="stat-card">
						<h3 id="totalClientes">0</h3>
						<p>Total de Clientes</p>
					</div>
				</div>
				<div id="tabelaClientes"></div>
			</div>
		</div>
	</div>

	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/clientes.js"></script>
</body>
</html>