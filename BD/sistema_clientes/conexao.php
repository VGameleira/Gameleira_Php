<?php

$host = 'localhost'; // Endereço do servidor de banco de dados
$banco = 'sistema_clientes'; // Nome do banco de dados
$usuario = 'root'; // Nome do usuário do banco de dados
$senha = ''; // Senha do usuário do banco de dados

try {
    // Cria uma nova conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    // Define o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem de erro
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}























?>