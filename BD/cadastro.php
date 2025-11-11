<?php
require 'conexão.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];

    // Verifica se os campos não estão vazios
    if (!empty($nome) && !empty($endereco) && !empty($cidade) && !empty($bairro)) {
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, endereco, cidade, bairro) 
        VALUES (:nome, :endereco, :cidade, :bairro)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':bairro', $bairro);



        if ($stmt->execute()) {
            // Sucesso
            echo "Cliente cadastrado com sucesso!";
        } else {
            // Falha
            echo "Erro ao cadastrar cliente.";
        }
    } else {
        // Campos vazios
        echo "Por favor, preencha todos os campos.";
    }}








?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <div class="form-container">
        <h2>Cadastrar Novo Cliente</h2>
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required>


            <button type="submit">Cadastrar</button>
        </form>

    </div>
</body>
</html>








































<?php

?>
