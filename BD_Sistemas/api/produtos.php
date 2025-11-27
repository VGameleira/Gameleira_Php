<?php
// BD_Sistemas/api/produtos_cliente.php
header('Content-Type: application/json; charset=utf-8');
session_start();

require_once '../conexoes/conex_produtos.php';

// Verificar se está logado
if (!isset($_SESSION['cliente_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Não autenticado']);
    exit;
}

$cliente_id = $_SESSION['cliente_id'];

// LISTAR PRODUTOS COM FILTROS
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoria = $_GET['categoria'] ?? '';
    $preco_min = $_GET['preco_min'] ?? 0;
    $preco_max = $_GET['preco_max'] ?? 999999999;
    $busca = $_GET['busca'] ?? '';
    
    $sql = "SELECT * FROM produtos WHERE disponivel = 1 AND preco BETWEEN ? AND ?";
    $params = [$preco_min, $preco_max];
    
    if (!empty($categoria)) {
        $sql .= " AND categoria = ?";
        $params[] = $categoria;
    }
    
    if (!empty($busca)) {
        $sql .= " AND (nome LIKE ? OR descricao LIKE ?)";
        $params[] = "%$busca%";
        $params[] = "%$busca%";
    }
    
    $sql .= " ORDER BY data_cadastro DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'data' => $produtos]);
    exit;
}

// ADICIONAR AO CARRINHO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_carrinho') {
    $produto_id = $_POST['produto_id'] ?? 0;
    $quantidade = $_POST['quantidade'] ?? 1;
    
    // Verificar estoque
    $stmt = $pdo->prepare("SELECT quantidade FROM produtos WHERE id = ?");
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$produto || $produto['quantidade'] < $quantidade) {
        echo json_encode(['success' => false, 'message' => 'Produto indisponível ou quantidade insuficiente']);
        exit;
    }
    
    // Verificar se já está no carrinho
    $stmt = $pdo->prepare("SELECT id, quantidade FROM carrinho WHERE cliente_id = ? AND produto_id = ?");
    $stmt->execute([$cliente_id, $produto_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($item) {
        // Atualizar quantidade
        $nova_qtd = $item['quantidade'] + $quantidade;
        $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id = ?");
        $stmt->execute([$nova_qtd, $item['id']]);
    } else {
        // Inserir novo item
        $stmt = $pdo->prepare("INSERT INTO carrinho (cliente_id, produto_id, quantidade) VALUES (?, ?, ?)");
        $stmt->execute([$cliente_id, $produto_id, $quantidade]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Produto adicionado ao carrinho!']);
    exit;
}

// LISTAR CARRINHO
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'carrinho') {
    $stmt = $pdo->prepare("
        SELECT c.*, p.nome, p.preco, p.descricao, (c.quantidade * p.preco) as subtotal
        FROM carrinho c 
        JOIN produtos p ON c.produto_id = p.id 
        WHERE c.cliente_id = ?
    ");
    $stmt->execute([$cliente_id]);
    $carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $total = array_sum(array_column($carrinho, 'subtotal'));
    
    echo json_encode(['success' => true, 'data' => $carrinho, 'total' => $total]);
    exit;
}

// REMOVER DO CARRINHO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remover_carrinho') {
    $item_id = $_POST['item_id'] ?? 0;
    
    $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id = ? AND cliente_id = ?");
    
    if ($stmt->execute([$item_id, $cliente_id])) {
        echo json_encode(['success' => true, 'message' => 'Item removido do carrinho']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao remover item']);
    }
    exit;
}

// ATUALIZAR QUANTIDADE NO CARRINHO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'atualizar_carrinho') {
    $item_id = $_POST['item_id'] ?? 0;
    $quantidade = $_POST['quantidade'] ?? 1;
    
    if ($quantidade < 1) {
        echo json_encode(['success' => false, 'message' => 'Quantidade inválida']);
        exit;
    }
    
    $stmt = $pdo->prepare("UPDATE carrinho SET quantidade = ? WHERE id = ? AND cliente_id = ?");
    
    if ($stmt->execute([$quantidade, $item_id, $cliente_id])) {
        echo json_encode(['success' => true, 'message' => 'Carrinho atualizado']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);