-- Banco de Dados de Produtos (Atualizado)
CREATE DATABASE IF NOT EXISTS sistema_produtos;
USE sistema_produtos;

CREATE TABLE clientes_produtos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    descricao TEXT,
    categoria VARCHAR(50),
    imagem_url VARCHAR(255),
    disponivel BOOLEAN DEFAULT TRUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carrinho(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    data_adicao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes_produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);


-- Inserir dados de exemplo para produtos
INSERT INTO produtos (nome, preco, quantidade, descricao, categoria) VALUES 
('Notebook Dell Inspiron', 3500.00, 10, 'Notebook com Intel Core i5, 8GB RAM, 256GB SSD', 'Informática'),
('Smartphone Samsung Galaxy', 2000.00, 25, 'Smartphone com tela de 6.5", 128GB, câmera tripla', 'Celulares'),
('Smart TV 50 Polegadas', 2200.00, 15, 'Smart TV LED 50" 4K, WiFi, HDR', 'Eletrônicos'),
('Cadeira Gamer', 850.00, 30, 'Cadeira ergonômica para escritório e gaming', 'Móveis'),
('Fone de Ouvido Bluetooth', 250.00, 50, 'Fone wireless com cancelamento de ruído', 'Áudio');