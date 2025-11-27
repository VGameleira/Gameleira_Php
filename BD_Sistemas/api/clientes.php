<?php
// BD_Sistemas/api/auth.php
header('Content-Type: application/json; charset=utf-8');
session_start();

$sistema = $_GET['sistema'] ?? 'clientes'; // clientes, imoveis ou produtos

// Determinar qual banco usar
$conexao_file = '';
$tabela_clientes = '';

switch($sistema) {
    case 'imoveis':
        $conexao_file = '../conexoes/conex_imoveis.php';
        $tabela_clientes = 'clientes_imoveis';
        break;
    case 'produtos':
        $conexao_file = '../conexoes/conex_produtos.php';
        $tabela_clientes = 'clientes_produtos';
        break;
    default:
        $conexao_file = '../conexoes/conex_clientes.php';
        $tabela_clientes = 'clientes';
}

require_once $conexao_file;

// REGISTRO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $nome = trim($_POST['nome'] ?? '');
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if (empty($nome) || empty($cpf) || empty($senha)) {
        echo json_encode(['success' => false, 'message' => 'Preencha todos os campos obrigatórios']);
        exit;
    }
    
    // Verificar se CPF já existe
    $stmt = $pdo->prepare("SELECT id FROM $tabela_clientes WHERE cpf = ?");
    $stmt->execute([$cpf]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'CPF já cadastrado']);
        exit;
    }
    
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO $tabela_clientes (nome, cpf, email, telefone, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nome, $cpf, $email, $telefone, $senha_hash])) {
        $_SESSION['cliente_id'] = $pdo->lastInsertId();
        $_SESSION['cliente_nome'] = $nome;
        $_SESSION['sistema'] = $sistema;
        echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao realizar cadastro']);
    }
    exit;
}

// LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if (empty($cpf) || empty($senha)) {
        echo json_encode(['success' => false, 'message' => 'Preencha todos os campos']);
        exit;
    }
    
    $stmt = $pdo->prepare("SELECT id, nome, senha FROM $tabela_clientes WHERE cpf = ?");
    $stmt->execute([$cpf]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($cliente && password_verify($senha, $cliente['senha'])) {
        $_SESSION['cliente_id'] = $cliente['id'];
        $_SESSION['cliente_nome'] = $cliente['nome'];
        $_SESSION['sistema'] = $sistema;
        echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso!', 'nome' => $cliente['nome']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'CPF ou senha inválidos']);
    }
    exit;
}

// LOGOUT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Logout realizado']);
    exit;
}

// VERIFICAR SESSÃO
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'check') {
    if (isset($_SESSION['cliente_id'])) {
        echo json_encode([
            'success' => true,
            'logged_in' => true,
            'cliente_id' => $_SESSION['cliente_id'],
            'cliente_nome' => $_SESSION['cliente_nome']
        ]);
    } else {
        echo json_encode(['success' => true, 'logged_in' => false]);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);