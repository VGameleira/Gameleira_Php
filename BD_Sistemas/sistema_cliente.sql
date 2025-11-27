-- Banco de Dados de Clientes 
CREATE DATABASE IF NOT EXISTS sistema_clientes;
USE sistema_clientes;

CREATE TABLE clientes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(20),
    endereco VARCHAR(150),
    cidade VARCHAR(50),
    bairro VARCHAR(50),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);