CREATE DATABASE IF NOT EXISTS sistema_imoveis;
USE sistema_imoveis;

CREATE TABLE clientes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    endereco VARCHAR(150),
    cidade VARCHAR(50),
    bairro VARCHAR(50)
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
    descricao TEXT
);




INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Rua das Flores, Centro', 350000.0, 80.0, 0.0, 2, 2, 1, 'Apartamento moderno com 2 quartos, 2 banheiros, sala ampla e cozinha planejada. Localizado no centro da cidade.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Av. Brasil, Bairro Alto', 450000.0, 100.0, 0.0, 3, 2, 2, 'Apartamento espaçoso com 3 quartos, varanda gourmet e 2 vagas de garagem. Próximo a escolas e comércio.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'aluguel', 'Rua das Palmeiras, Zona Sul', 1800.0, 70.0, 0.0, 2, 1, 1, 'Apartamento para aluguel com 2 quartos, 1 banheiro, cozinha americana e área de serviço. Condomínio com piscina.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Rua do Sol, Bairro Jardim', 520000.0, 120.0, 0.0, 3, 3, 2, 'Apartamento de alto padrão com 3 suítes, sala integrada à varanda, cozinha planejada e área de lazer completa.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'aluguel', 'Av. Central, Centro', 2200.0, 90.0, 0.0, 2, 2, 1, 'Apartamento mobiliado com 2 quartos, 2 banheiros, sala e cozinha completa. Excelente localização no centro.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Rua das Acácias, Bairro Verde', 300000.0, 65.0, 0.0, 2, 1, 1, 'Apartamento compacto com 2 quartos, ideal para casal ou investimento. Próximo a transporte público.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'aluguel', 'Rua das Hortênsias, Bairro Bela Vista', 1500.0, 60.0, 0.0, 1, 1, 1, 'Apartamento para aluguel com 1 quarto, sala, cozinha e banheiro. Condomínio tranquilo e seguro.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Av. Paulista, Centro', 800000.0, 150.0, 0.0, 4, 3, 3, 'Apartamento luxuoso com 4 quartos, sendo 2 suítes, ampla sala, varanda gourmet e vista panorâmica da cidade.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'aluguel', 'Rua das Margaridas, Bairro Primavera', 2000.0, 85.0, 0.0, 2, 2, 1, 'Apartamento para aluguel com 2 quartos, 2 banheiros, cozinha planejada e área de lazer no condomínio.');
INSERT INTO imoveis (tipo, finalidade, localizacao, preco, area_cons, area_terreno, qtd_quarto, qtd_banheiro, qtd_vaga, descricao) VALUES ('Apartamento', 'venda', 'Rua das Orquídeas, Bairro Lago Azul', 600000.0, 130.0, 0.0, 3, 2, 2, 'Apartamento com 3 quartos, sala ampla, cozinha moderna e varanda com vista para o lago. Condomínio com segurança.');
