<?php
require_once "conexao.php";

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
        $sql = "INSERT INTO sistema_imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao)
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

$sql = "SELECT * FROM sistema_imoveis ORDER BY id DESC";
$stmt = $pdo->query($sql);
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Imóvel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <h2>Cadastro de Imóvel</h2>
        <form method="POST">
            <label>Tipo de imóvel:</label>
            <input type="text" name="tipo" required>
            <label>Finalidade:</label>
            <select name="finalidade">
                <option value="venda">Venda</option>
                <option value="aluguel">Aluguel</option>
            </select>
            <label>Localização:</label>
            <input type="text" name="localizacao" required>
            <label>Preço:</label>
            <input type="number" name="preco" required>
            <label>Área construída (m²):</label>
            <input type="number" name="area_cons" required>
            <label>Área do terreno (m²):</label>
            <input type="number" name="area_terreno" required>
            <label>Quartos:</label>
            <input type="number" name="qtd_quarto" required>
            <label>Banheiros:</label>
            <input type="number" name="qtd_banheiro" required>
            <label>Vagas de garagem:</label>
            <input type="number" name="qtd_vaga" required>
            <label>Descrição:</label>
            <textarea name="descricao"></textarea>
            <button type="submit">Cadastrar Imóvel</button>
        </form>
        <?php if (isset($mensagem)) {
            echo "<div class='mensagem'>$mensagem</div>";
        } ?>
    </div>
    <?php if (!empty($imoveis)) { ?>
        <div class="tabela-container">
            <h3>Imóveis Cadastrados</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Finalidade</th>
                        <th>Localização</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($imoveis as $imovel) { ?>
                        <tr>
                            <td><?= $imovel['id'] ?></td>
                            <td><?= htmlspecialchars($imovel['tipo']) ?></td>
                            <td><?= htmlspecialchars($imovel['finalidade']) ?></td>
                            <td><?= htmlspecialchars($imovel['localizacao']) ?></td>
                            <td>R$ <?= htmlspecialchars($imovel['preco']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>

</html>