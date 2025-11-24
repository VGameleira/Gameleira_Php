<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../classes/Storage.php';
require_once __DIR__ . '/../classes/Imovel.php';

$storage = new Storage(__DIR__ . '/../data/imoveis.json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['success' => true, 'data' => $storage->all()], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $data['preco'] = isset($data['preco']) ? floatval($data['preco']) : 0;
    $data['qtd_quarto'] = isset($data['qtd_quarto']) ? intval($data['qtd_quarto']) : 0;
    $data['qtd_banheiro'] = isset($data['qtd_banheiro']) ? intval($data['qtd_banheiro']) : 0;
    $data['qtd_vaga'] = isset($data['qtd_vaga']) ? intval($data['qtd_vaga']) : 0;

    $imovel = new Imovel($data);
    $saved = $storage->save($imovel->toArray());
    echo json_encode(['success' => true, 'data' => $saved], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido']);
