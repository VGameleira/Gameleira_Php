# 📚 Sistema de Biblioteca - Versão 2.0

Sistema completo de gerenciamento de biblioteca com funcionalidades de cadastro de livros, usuários e controle de aluguéis.

## 🚀 Funcionalidades

### Para Administradores:
- ✅ Gerenciamento completo de usuários (cadastrar, editar, excluir)
- ✅ Gerenciamento completo de livros com upload de imagens
- ✅ Alugar livros para qualquer usuário
- ✅ Visualizar todos os aluguéis do sistema
- ✅ Dashboard com estatísticas
- ✅ Processar devoluções

### Para Alunos:
- ✅ Visualizar catálogo de livros
- ✅ Alugar livros disponíveis
- ✅ Visualizar histórico de aluguéis
- ✅ Devolver livros
- ✅ Alertas de vencimento e atrasos

## 📋 Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor Apache ou Nginx
- Extensões PHP: PDO, GD (para manipulação de imagens)

## 🔧 Instalação

### 1. Configurar o Banco de Dados

Execute o seguinte SQL no seu MySQL:

```sql
CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE biblioteca;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'aluno') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    disponivel BOOLEAN DEFAULT TRUE,
    imagem VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_livro INT NOT NULL,
    data_aluguel DATE NOT NULL,
    data_devolucao DATE NOT NULL,
    devolvido BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_livro) REFERENCES livros(id) ON DELETE CASCADE,
    INDEX idx_usuario (id_usuario),
    INDEX idx_livro (id_livro),
    INDEX idx_devolvido (devolvido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir usuário admin padrão (senha: admin123)
INSERT INTO usuarios (nome, email, senha, tipo) 
VALUES ('Administrador', 'admin@biblioteca.com', '$2y$10$YourHashedPasswordHere', 'admin');
```

### 2. Gerar senha para o usuário admin

Execute este PHP para gerar o hash da senha:

```php
<?php
echo password_hash('admin123', PASSWORD_DEFAULT);
?>
```

Copie o hash gerado e substitua na query acima.

### 3. Configurar o Sistema

Edite o arquivo `config.php` e ajuste as credenciais do banco de dados:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'biblioteca');
define('DB_USER', 'root');
define('DB_PASS', 'sua_senha');
```

### 4. Estrutura de Diretórios

Organize os arquivos conforme a estrutura abaixo:

```
biblioteca/
├── config.php
├── index.php
├── painel.php
├── logout.php
├── css/
│   └── style.css
├── uploads/ (pasta criada automaticamente)
├── usuarios/
│   ├── cadastrar.php
│   ├── listar.php
│   ├── editar.php
│   └── excluir.php
├── livros/
│   ├── cadastrar.php
│   ├── listar.php
│   ├── editar.php
│   └── excluir.php
└── alugueis/
    ├── cadastrar.php
    ├── listar.php
    └── devolver.php
```

### 5. Permissões

Configure as permissões da pasta uploads:

```bash
chmod 755 uploads/
```

## 🔐 Acesso ao Sistema

### Credenciais padrão:
- **Email:** admin@biblioteca.com
- **Senha:** admin123

⚠️ **IMPORTANTE:** Altere a senha padrão após o primeiro acesso!

## 🎨 Recursos Técnicos

### Segurança:
- ✅ Proteção contra SQL Injection com PDO Prepared Statements
- ✅ Sanitização de inputs com htmlspecialchars
- ✅ Senhas criptografadas com password_hash (bcrypt)
- ✅ Validação de tipos de arquivo no upload
- ✅ Proteção de sessão com httponly cookies
- ✅ Controle de permissões por tipo de usuário

### Performance:
- ✅ Queries otimizadas com índices
- ✅ Transações para operações críticas
- ✅ Carregamento eficiente de imagens

### UX/UI:
- ✅ Interface responsiva
- ✅ Design moderno com gradientes
- ✅ Animações suaves
- ✅ Feedback visual para todas as ações
- ✅ Alertas de vencimento de aluguéis
- ✅ Sistema de filtros e busca

## 📊 Funcionalidades Avançadas

### Dashboard Administrativo:
- Total de livros cadastrados
- Livros disponíveis
- Total de usuários
- Aluguéis ativos
- Alertas de aluguéis atrasados

### Sistema de Aluguéis:
- Controle de datas com validação
- Status visual (ativo, atrasado, devolvido)
- Contagem regressiva de dias
- Alertas de vencimento próximo
- Histórico completo

### Gerenciamento de Livros:
- Upload de imagens de capa
- Filtros por disponibilidade
- Busca por título ou autor
- Preview de imagens no cadastro

## 🐛 Troubleshooting

### Erro de conexão com banco de dados:
- Verifique as credenciais em `config.php`
- Confirme que o MySQL está rodando
- Verifique se o banco de dados foi criado

### Upload de imagens não funciona:
- Verifique as permissões da pasta `uploads/`
- Confirme que a extensão GD está habilitada
- Verifique o tamanho máximo de upload no php.ini

### Sessão não persiste:
- Verifique se `session_start()` é chamado
- Confirme as configurações de cookie no php.ini
- Limpe o cache do navegador

## 📝 Melhorias Implementadas

- ✅ Arquivo de configuração centralizado (config.php)
- ✅ Funções auxiliares reutilizáveis
- ✅ Validação robusta de inputs
- ✅ Tratamento de erros com try-catch
- ✅ Mensagens de feedback para o usuário
- ✅ Preview de imagens antes do upload
- ✅ Sistema de filtros avançado
- ✅ Estatísticas em tempo real
- ✅ Interface moderna e responsiva
- ✅ Código organizado e comentado

## 📄 Licença

Este projeto é livre para uso educacional e comercial.

## 👨‍💻 Suporte

Para dúvidas e sugestões, entre em co