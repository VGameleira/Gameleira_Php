<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../classes/Storage.php';
require_once __DIR__ . '/../classes/Produto.php';

$storage = new Storage(__DIR__ . '/../data/produtos.json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['success' => true, 'data' => $storage->all()], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    // garantia de tipos básicos
    $data['preco'] = isset($data['preco']) ? floatval($data['preco']) : 0;
    $data['quantidade'] = isset($data['quantidade']) ? intval($data['quantidade']) : 0;
    $produto = new Produto($data);
    $saved = $storage->save($produto->toArray());
    echo json_encode(['success' => true, 'data' => $saved], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);
