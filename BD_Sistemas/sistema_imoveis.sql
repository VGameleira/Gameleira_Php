-- Banco de Dados de Imóveis (Atualizado)
CREATE DATABASE IF NOT EXISTS sistema_imoveis;
USE sistema_imoveis;

CREATE TABLE clientes_imoveis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE imoveis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(30) NOT NULL,
    finalidade VARCHAR(20) NOT NULL,
    localizacao VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    area_cons DECIMAL(10,2) NOT NULL,
    area_terreno DECIMAL(10,2) NOT NULL,
    qtd_quarto INT NOT NULL,
    qtd_banheiro INT NOT NULL,
    qtd_vaga INT NOT NULL,
    descricao TEXT,
    imagem_url VARCHAR(255),
    disponivel BOOLEAN DEFAULT TRUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE interesse_imoveis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    imovel_id INT NOT NULL,
    data_interesse TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    observacoes TEXT,
    FOREIGN KEY (cliente_id) REFERENCES clientes_imoveis(id) ON DELETE CASCADE,
    FOREIGN KEY (imovel_id) REFERENCES imoveis(id) ON DELETE CASCADE
);

-- Inserir dados de exemplo para imóveis
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES 
('Apartamento', 'Venda', 'Rua das Flores, Centro', 350000.0, 80.0, 0.0, 2, 2, 1, 'Apartamento moderno com 2 quartos, 2 banheiros, sala ampla e cozinha planejada. Localizado no centro da cidade.'),
('Apartamento', 'Venda', 'Av. Brasil, Bairro Alto', 450000.0, 100.0, 0.0, 3, 2, 2, 'Apartamento espaçoso com 3 quartos, varanda gourmet e 2 vagas de garagem. Próximo a escolas e comércio.'),
('Casa', 'Aluguel', 'Rua das Palmeiras, Zona Sul', 2500.0, 120.0, 200.0, 3, 2, 2, 'Casa para aluguel com 3 quartos, 2 banheiros, quintal amplo e área gourmet.'),
('Apartamento', 'Venda', 'Rua do Sol, Bairro Jardim', 520000.0, 120.0, 0.0, 3, 3, 2, 'Apartamento de alto padrão com 3 suítes, sala integrada à varanda, cozinha planejada e área de lazer completa.'),
('Casa', 'Venda', 'Av. Central, Centro', 680000.0, 150.0, 300.0, 4, 3, 3, 'Casa espaçosa com 4 quartos, piscina, churrasqueira e amplo jardim.');