<?php
// BD_Sistemas/api/imoveis_cliente.php
header('Content-Type: application/json; charset=utf-8');
session_start();

require_once '../conexoes/conex_imoveis.php';

// Verificar se está logado
if (!isset($_SESSION['cliente_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Não autenticado']);
    exit;
}

$cliente_id = $_SESSION['cliente_id'];

// LISTAR IMÓVEIS COM FILTROS
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tipo = $_GET['tipo'] ?? '';
    $finalidade = $_GET['finalidade'] ?? '';
    $preco_min = $_GET['preco_min'] ?? 0;
    $preco_max = $_GET['preco_max'] ?? 999999999;
    $quartos = $_GET['quartos'] ?? 0;
    
    $sql = "SELECT i.*, 
            (SELECT COUNT(*) FROM interesse_imoveis WHERE imovel_id = i.id AND cliente_id = ?) as interessado
            FROM imoveis i 
            WHERE disponivel = 1 
            AND preco BETWEEN ? AND ?";
    
    $params = [$cliente_id, $preco_min, $preco_max];
    
    if (!empty($tipo)) {
        $sql .= " AND tipo = ?";
        $params[] = $tipo;
    }
    
    if (!empty($finalidade)) {
        $sql .= " AND finalidade = ?";
        $params[] = $finalidade;
    }
    
    if ($quartos > 0) {
        $sql .= " AND qtd_quarto >= ?";
        $params[] = $quartos;
    }
    
    $sql .= " ORDER BY data_cadastro DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'data' => $imoveis]);
    exit;
}

// REGISTRAR INTERESSE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'interesse') {
    $imovel_id = $_POST['imovel_id'] ?? 0;
    $observacoes = $_POST['observacoes'] ?? '';
    
    // Verificar se já tem interesse
    $stmt = $pdo->prepare("SELECT id FROM interesse_imoveis WHERE cliente_id = ? AND imovel_id = ?");
    $stmt->execute([$cliente_id, $imovel_id]);
    
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Você já demonstrou interesse neste imóvel']);
        exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO interesse_imoveis (cliente_id, imovel_id, observacoes) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$cliente_id, $imovel_id, $observacoes])) {
        echo json_encode(['success' => true, 'message' => 'Interesse registrado! Entraremos em contato em breve.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registrar interesse']);
    }
    exit;
}

// REMOVER INTERESSE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remover_interesse') {
    $imovel_id = $_POST['imovel_id'] ?? 0;
    
    $stmt = $pdo->prepare("DELETE FROM interesse_imoveis WHERE cliente_id = ? AND imovel_id = ?");
    
    if ($stmt->execute([$cliente_id, $imovel_id])) {
        echo json_encode(['success' => true, 'message' => 'Interesse removido']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao remover interesse']);
    }
    exit;
}

// LISTAR MEUS INTERESSES
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'meus_interesses') {
    $stmt = $pdo->prepare("
        SELECT i.*, ii.data_interesse, ii.observacoes 
        FROM interesse_imoveis ii 
        JOIN imoveis i ON ii.imovel_id = i.id 
        WHERE ii.cliente_id = ? 
        ORDER BY ii.data_interesse DESC
    ");
    $stmt->execute([$cliente_id]);
    $interesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'data' => $interesses]);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);