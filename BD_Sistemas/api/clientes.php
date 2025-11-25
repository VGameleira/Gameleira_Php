<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../classes/Storage.php';
require_once __DIR__ . '/../classes/Cliente.php';

$storage = new Storage(__DIR__ . '/../data/clientes.json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['success' => true, 'data' => $storage->all()], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = new Cliente($_POST);
    $saved = $storage->save($cliente->toArray());
    echo json_encode(['success' => true, 'data' => $saved], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);
