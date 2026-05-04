# Arquitetura do Projeto Gameleira_Php

## Visão Geral

Este projeto segue os princípios de **MVC (Model-View-Controller)** com separação de responsabilidades e boas práticas de desenvolvimento web.

## Estrutura de Pastas

```
Gameleira_Php/
├── ATV-UC03-AVAL2-Gameleira/    # Módulo: Sistema Avaliação 2
│   ├── index.php                # Entry point
│   ├── css/                     # Estilos
│   ├── js/                      # Scripts
│   └── config.php               # Configuração local
│
├── ATV-UC03-AVAL3-Gameleira/    # Módulo: Sistema Avaliação 3 (Melhorado)
│   ├── descontoidoso/           # Submodelo: Desconto
│   ├── descontovip/             # Submodelo: VIP
│   └── tabuada/                 # Submodelo: Tabuada
│
├── Biblioteca/                  # Módulo: Sistema de Biblioteca
│   ├── index.php
│   ├── models/
│   │   ├── Livro.php
│   │   ├── Usuario.php
│   │   └── Emprestimo.php
│   ├── views/
│   │   ├── lista_livros.php
│   │   ├── form_livro.php
│   │   └── detalhes_livro.php
│   └── controllers/
│       ├── LivroController.php
│       ├── UsuarioController.php
│       └── EmprestimoController.php
│
├── gerenciadorEstoque_PHP_Gameleira/  # Módulo: Estoque
│   ├── Models/
│   ├── Controllers/
│   └── Views/
│
├── POO/                         # Módulo: Exemplos de OOP
│   ├── Classe.php
│   ├── Heranca.php
│   ├── Interface.php
│   └── Polimorfismo.php
│
├── BD/                          # Scripts de Banco de Dados
│   ├── schema.sql               # Criação de tabelas
│   ├── data.sql                 # Dados iniciais
│   └── migrations/              # Migrações futuras
│
├── config/                      # Configuração Global
│   ├── .env.example             # Variáveis de ambiente
│   ├── database.php             # Conexão BD
│   ├── routes.php               # Rotas da aplicação
│   └── constants.php            # Constantes globais
│
├── src/                         # Código Geral
│   ├── Database/
│   │   └── Connection.php       # Classe de conexão
│   ├── Validation/              # Validadores
│   ├── Utils/                   # Utilidades
│   └── Helpers/                 # Funções auxiliares
│
├── public/                      # Pasta pública (Web root)
│   └── index.php                # Entrada principal
│
├── tests/                       # Testes
│   ├── unit/
│   ├── integration/
│   └── bootstrap.php
│
├── logs/                        # Arquivos de log
├── cache/                       # Cache da aplicação
├── .gitignore                   # Controle de versão
├── .env.example                 # Exemplo de configuração
├── README.md                    # Documentação
├── LICENSE                      # Licença
└── composer.json                # Dependências PHP
```

## Padrões de Design

### 1. MVC Pattern
```
Request
   ↓
Router → Controller
           ↓
        Model (BD)
           ↓
        View (HTML)
           ↓
Response
```

### 2. Singleton Pattern (Database Connection)
```php
// Garante apenas uma conexão com BD
class Database {
    private static $instance;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
```

### 3. Active Record Pattern (Models)
```php
// Model com métodos diretos
$livro = Livro::find(1);
$livro->titulo = "Novo Título";
$livro->save();
```

## Fluxo de Dados

### Criar Livro
```
1. User submete form → POST /biblioteca/livros
2. Router identifica rota → LivroController::create()
3. Controller valida dados → Validation::check()
4. Chama Model → Livro::store($dados)
5. Model insere BD → INSERT INTO livros
6. Retorna resultado → JSON ou HTML
7. Usuario vê sucesso → Redirect + Message
```

### Listar Livros
```
1. User acessa /biblioteca → GET /biblioteca
2. Router → LivroController::index()
3. Controller chama → Livro::all()
4. Model busca BD → SELECT * FROM livros
5. Controller passa dados → View
6. View renderiza HTML
7. Usuario vê lista
```

## Camadas de Responsabilidade

### Model (Lógica de Dados)
**Responsabilidades:**
- Estrutura e validação de dados
- Operações com banco de dados
- Regras de negócio
- Relacionamentos entre entidades

**Exemplo:**
```php
class Livro {
    public $id;
    public $titulo;
    public $autor;
    
    // Validações
    public function validar() {
        if (empty($this->titulo)) {
            throw new Exception("Título obrigatório");
        }
    }
    
    // Operações BD
    public function save() { /* ... */ }
    public static function find($id) { /* ... */ }
    public static function all() { /* ... */ }
}
```

### View (Apresentação)
**Responsabilidades:**
- Renderizar HTML
- Exibir dados
- Interação com usuário
- Design e layout

**Exemplo:**
```php
<!-- lista_livros.php -->
<table>
    <?php foreach ($livros as $livro): ?>
        <tr>
            <td><?= htmlspecialchars($livro->titulo) ?></td>
            <td><?= htmlspecialchars($livro->autor) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```

### Controller (Orquestração)
**Responsabilidades:**
- Processar requisições
- Validar entrada
- Chamar Models
- Passar dados para Views
- Tratamento de erros

**Exemplo:**
```php
class LivroController {
    public function store() {
        // Validação
        if (empty($_POST['titulo'])) {
            return $this->error("Título obrigatório");
        }
        
        // Criar modelo
        $livro = new Livro();
        $livro->titulo = $_POST['titulo'];
        $livro->autor = $_POST['autor'];
        
        // Salvar
        try {
            $livro->save();
            return $this->success("Livro criado!");
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
```

## Decisões de Design

### 1. Por que MVC?
- ✅ Separação clara de responsabilidades
- ✅ Fácil de testar
- ✅ Manutenção simplificada
- ✅ Escalabilidade

### 2. Por que PHP?
- ✅ Linguagem de servidor padrão
- ✅ Fácil deploy
- ✅ Comunidade grande
- ✅ Bom para aplicações web tradicionais

### 3. Por que MySQL?
- ✅ Banco relacional
- ✅ Performance
- ✅ Confiabilidade
- ✅ Uso geral

## Segurança

### Validação de Entrada
```php
// SEMPRE validar
$titulo = htmlspecialchars($_POST['titulo'] ?? '');
$autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
```

### Prepared Statements
```php
// SIM - Previne SQL Injection
$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->execute([$id]);

// NÃO - Vulnerável!
$sql = "SELECT * FROM livros WHERE id = " . $_GET['id'];
```

### XSS Protection
```php
// SIM - Escapa saída
<?= htmlspecialchars($livro->titulo) ?>

// NÃO - Vulnerável!
<?= $livro->titulo ?>
```

## Testes

### Estrutura de Testes
```
tests/
├── unit/
│   ├── Models/
│   │   └── LivroTest.php        # Testa Model
│   └── Validation/
│       └── ValidatorTest.php    # Testa Validação
│
└── integration/
    ├── Controllers/
    │   └── LivroControllerTest.php  # Testa fluxo completo
    └── API/
        └── ApiTest.php              # Testa endpoints
```

### Exemplo de Teste
```php
class LivroTest extends TestCase {
    public function testCriarLivro() {
        $livro = new Livro();
        $livro->titulo = "1984";
        $livro->autor = "George Orwell";
        
        $this->assertTrue($livro->validar());
        $this->assertEquals("1984", $livro->titulo);
    }
}
```

## Próximos Passos de Refatoração

### Curto Prazo (2 semanas)
- [ ] Validação centralizada
- [ ] Tratamento global de erros
- [ ] Estrutura de pastas padronizada
- [ ] Testes unitários

### Médio Prazo (1 mês)
- [ ] Autenticação JWT
- [ ] API RESTful completa
- [ ] Testes de integração
- [ ] Documentação Swagger

### Longo Prazo (2 meses)
- [ ] Frontend React
- [ ] WebSockets
- [ ] Docker & DevOps
- [ ] Monitoramento

## Referências

- [PHP Standards Recommendations](https://www.php-fig.org/psr/)
- [OWASP Security](https://owasp.org/)
- [Design Patterns](https://www.designpatternsphp.net/)

---

**Versão**: 1.0  
**Última atualização**: 04 de Maio de 2026
