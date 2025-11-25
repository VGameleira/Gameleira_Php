<?php
require_once '../conexoes/conex_imoveis.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $finalidade = $_POST["finalidade"];
    $localizacao = $_POST["localizacao"];
    $preco = $_POST["preco"];
    $area_cons = $_POST["area_cons"];
    $area_terreno = $_POST["area_terreno"];
    $qtd_quarto = $_POST["qtd_quarto"];
    $qtd_banheiro = $_POST["qtd_banheiro"];
    $qtd_vaga = $_POST["qtd_vaga"];
    $descricao = $_POST["descricao"];

    if (!empty($tipo) && !empty($finalidade) && !empty($localizacao) && !empty($preco)) {
        $sql = "INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao)
                VALUES (:tipo, :finalidade, :localizacao, :preco, :area_cons, :area_terreno, :qtd_quarto, :qtd_banheiro, :qtd_vaga, :descricao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":finalidade", $finalidade);
        $stmt->bindParam(":localizacao", $localizacao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":area_cons", $area_cons);
        $stmt->bindParam(":area_terreno", $area_terreno);
        $stmt->bindParam(":qtd_quarto", $qtd_quarto);
        $stmt->bindParam(":qtd_banheiro", $qtd_banheiro);
        $stmt->bindParam(":qtd_vaga", $qtd_vaga);
        $stmt->bindParam(":descricao", $descricao);

        if ($stmt->execute()) {
            $mensagem = "Imóvel cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar imóvel.";
        }
    } else {
        $mensagem = "Preencha os campos obrigatórios!";
    }
}

$sql = "SELECT * FROM imoveis ORDER BY id DESC";
$stmt = $pdo->query($sql);
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Imóveis - Sistema</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>🏠 Sistema Imobiliário</h1>
			<p><a href="index.html">Voltar ao menu</a></p>
		</header>

		<div class="system-container">
			<form id="formImoveis">
				<div class="form-grid">
					<div class="form-group">
						<label>Tipo de Imóvel *</label>
						<select name="tipo" required>
							<option value="">Selecione...</option>
							<option value="Casa">Casa</option>
							<option value="Apartamento">Apartamento</option>
							<option value="Terreno">Terreno</option>
							<option value="Kitnet">Kitnet</option>
							<option value="Sobrado">Sobrado</option>
							<option value="Chácara">Chácara</option>
						</select>
					</div>
					<div class="form-group">
						<label>Finalidade *</label>
						<select name="finalidade" required>
							<option value="Venda">Venda</option>
							<option value="Aluguel">Aluguel</option>
						</select>
					</div>
					<div class="form-group">
						<label>Localização *</label>
						<input type="text" name="localizacao" required placeholder="Endereço completo">
					</div>
					<div class="form-group">
						<label>Preço (R$) *</label>
						<input type="number" name="preco" step="0.01" min="0" required placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Área Construída (m²)</label>
						<input type="number" name="area_cons" min="0" placeholder="0">
					</div>
					<div class="form-group">
						<label>Área do Terreno (m²)</label>
						<input type="number" name="area_terreno" min="0" placeholder="0">
					</div>
					<div class="form-group">
						<label>Quartos</label>
						<input type="number" name="qtd_quarto" min="0" placeholder="0">
					</div>
					<div class="form-group">
						<label>Banheiros</label>
						<input type="number" name="qtd_banheiro" min="0" placeholder="0">
					</div>
					<div class="form-group">
						<label>Vagas de Garagem</label>
						<input type="number" name="qtd_vaga" min="0" placeholder="0">
					</div>
					<div class="form-group" style="grid-column: 1 / -1;">
						<label>Descrição</label>
						<textarea name="descricao" placeholder="Descreva o imóvel em detalhes..."></textarea>
					</div>
				</div>
				<button type="submit" class="btn-submit">✅ Cadastrar Imóvel</button>
			</form>

			<div id="alertImoveis"></div>

			<div class="table-container">
				<h3 style="margin-bottom:20px;color:#667eea;">📋 Imóveis Cadastrados</h3>
				<div class="stats">
					<div class="stat-card">
						<h3 id="totalImoveis">0</h3>
						<p>Total de Imóveis</p>
					</div>
				</div>
				<div id="tabelaImoveis"></div>
			</div>
		</div>
	</div>

	<script src="../assets/js/app.js"></script>
	<script src="../assets/js/imoveis.js"></script>
</body>
</html>