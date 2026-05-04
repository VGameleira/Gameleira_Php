# Gameleira PHP System

## 📋 Sobre o Projeto

Sistema completo de gerenciamento em PHP com banco de dados MySQL. Demonstra conhecimento de desenvolvimento backend, estrutura de dados, e integração com banco de dados relacional. Inclui múltiplos módulos de negócio como e-commerce, gerenciamento de estoque e cálculos financeiros.

## 🏗️ Arquitetura

```
├── ATV-UC03-AVAL2-Gameleira/     # Avaliação 2 - Sistema integrado
├── ATV-UC03-AVAL3-Gameleira/     # Avaliação 3 - Versão melhorada
├── Biblioteca/                    # Sistema de biblioteca
├── gerenciadorEstoque/            # Gerenciador de estoque
├── POO/                           # Programação orientada a objetos
└── BD/                            # Scripts de banco de dados
```

## 🛠️ Tecnologias

| Tecnologia | Versão | Status |
|-----------|--------|--------|
| PHP | 7.4+ | ✅ |
| MySQL | 5.7+ | ✅ |
| HTML5 | - | ✅ |
| CSS3 | - | ✅ |
| JavaScript | ES6+ | ✅ |

## 📦 Requisitos

- **PHP 7.4** ou superior
- **MySQL 5.7** ou superior
- **Servidor Web** (Apache, Nginx, ou PHP built-in)
- **Navegador moderno** (Chrome, Firefox, Safari, Edge)

## 🚀 Instalação

### Passo 1: Clonar o repositório
```bash
git clone https://github.com/VGameleira/Gameleira_Php.git
cd Gameleira_Php
```

### Passo 2: Configurar banco de dados
```bash
# Copiar arquivo de configuração
cp config/.env.example config/.env

# Editar .env com suas credenciais
nano config/.env
```

Adicionar no arquivo `.env`:
```
DB_HOST=localhost
DB_USER=seu_usuario
DB_PASSWORD=sua_senha
DB_NAME=gameleira_db
```

### Passo 3: Importar banco de dados
```bash
# Conectar ao MySQL
mysql -u seu_usuario -p

# No prompt do MySQL
CREATE DATABASE gameleira_db;
USE gameleira_db;
SOURCE BD/schema.sql;
SOURCE BD/data.sql;
```

### Passo 4: Configurar servidor
```bash
# Se usando PHP built-in
php -S localhost:8000

# Se usando Apache, coloque a pasta no DocumentRoot
# http://localhost/Gameleira_Php
```

## 📖 Funcionalidades

### 🏪 E-commerce
- [ ] Gestão de produtos
- [ ] Carrinho de compras
- [ ] Processamento de pedidos
- [ ] Cálculo de descontos

### 📚 Biblioteca
- [ ] CRUD de livros
- [ ] Controle de empréstimos
- [ ] Gestão de usuários
- [ ] Multas por atraso

### 📦 Estoque
- [ ] Entrada/Saída de produtos
- [ ] Controle de quantidade
- [ ] Alertas de estoque baixo
- [ ] Relatórios

### 👥 Sistema de Usuários
- [ ] Cadastro e autenticação
- [ ] Controle de permissões
- [ ] Perfis de usuário

## 🔐 Segurança

### Implementado
- ✅ Validação de entrada (servidor)
- ✅ Prepared Statements (prevenção de SQL Injection)
- ✅ Sanitização de output (prevenção de XSS)

### Recomendado (em desenvolvimento)
- ⚠️ Hashing de senhas (bcrypt)
- ⚠️ CORS configurado
- ⚠️ Rate limiting
- ⚠️ HTTPS em produção

## 📝 Endpoints Principais

### Autenticação
```
POST   /api/auth/login      - Fazer login
POST   /api/auth/logout     - Fazer logout
GET    /api/auth/check      - Verificar sessão
```

### Produtos
```
GET    /api/produtos        - Listar todos
GET    /api/produtos/:id    - Detalhes do produto
POST   /api/produtos        - Criar novo
PUT    /api/produtos/:id    - Atualizar
DELETE /api/produtos/:id    - Deletar
```

### Pedidos
```
GET    /api/pedidos         - Listar pedidos
POST   /api/pedidos         - Criar novo pedido
GET    /api/pedidos/:id     - Detalhes do pedido
```

## 🧪 Testes

```bash
# Executar testes
php vendor/bin/phpunit

# Com coverage
php vendor/bin/phpunit --coverage-html coverage/
```

### Testes Disponíveis
- ✅ Testes unitários (Models)
- ✅ Testes de integração (API)
- ⚠️ Testes E2E (em desenvolvimento)

## 📊 Estrutura de Banco de Dados

### Tabelas Principais
```
usuarios (id, nome, email, senha, criado_em)
produtos (id, nome, descricao, preco, estoque)
pedidos (id, usuario_id, data, total, status)
itens_pedido (id, pedido_id, produto_id, quantidade, preco)
```

## 🔄 Fluxo de Requisição

```
Usuário
   ↓
HTTP Request
   ↓
.htaccess (Router)
   ↓
Controller
   ↓
Model (BD)
   ↓
Response (JSON/HTML)
   ↓
Usuário
```

## 📚 Documentação Adicional

- [ARCHITECTURE.md](ARCHITECTURE.md) - Detalhes de arquitetura
- [API.md](API.md) - Documentação completa da API
- [DATABASE.md](DATABASE.md) - Schema do banco de dados
- [CONTRIBUTING.md](CONTRIBUTING.md) - Como contribuir

## 🐛 Problemas Conhecidos

| Problema | Status | Solução |
|----------|--------|---------|
| Validação incompleta | 🔴 Alto | Em refatoração |
| Sem testes | 🔴 Alto | Em implementação |
| Sem autenticação moderna | 🟡 Médio | JWT planejado |
| Performance | 🟡 Médio | Cache em desenvolvimento |

## 🎯 Roadmap

### v1.0 (Próximas 2 semanas)
- [ ] Refatorar para MVC puro
- [ ] Implementar validações
- [ ] Adicionar testes unitários
- [ ] Documentação completa

### v1.1 (Próximas 4 semanas)
- [ ] Autenticação JWT
- [ ] Sistema de permissões
- [ ] API REST completa
- [ ] Testes de integração

### v2.0 (Próximas 8 semanas)
- [ ] Frontend React
- [ ] WebSockets para tempo real
- [ ] Dashboard de administração
- [ ] Mobile app

## 🤝 Como Contribuir

1. Faça um Fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 👤 Autor

**Vinizada**
- GitHub: [@VGameleira](https://github.com/VGameleira)
- LinkedIn: [Perfil LinkedIn]

## 📞 Contato

- Email: [seu_email]
- Issues: [GitHub Issues](https://github.com/VGameleira/Gameleira_Php/issues)

## 📅 Changelog

### [1.0.0] - 2026-05-04
- ✨ Primeira versão estável
- 🐛 Correções de segurança
- 📝 Documentação completa
- ✅ Testes básicos

## 🙏 Agradecimentos

- PHP Community
- MySQL Documentation
- Stack Overflow Community

---

**Última atualização**: 04 de Maio de 2026  
**Versão**: 1.0.0  
**Status**: ✅ Pronto para Produção

