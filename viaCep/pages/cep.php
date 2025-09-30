<?php
$cep = preg_replace('/\D/', '', $_GET['cepBuscado'] ?? '');
$mensagem = "";
$dados = null;

if (!isset($cep) || strlen($cep) != 8) {
    $mensagem = "ERRO, VALORES INVÁLIDOS";
} else {
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    
    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Content-Type: application/json"
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        $mensagem = "Erro ao acessar a API ViaCEP.";
    } else {
        $dados = json_decode($response, true);

        if (isset($dados["erro"])) {
            $mensagem = "CEP não encontrado.";
            $dados = null; // força $dados a ser nulo para não exibir os inputs
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado CEP</title>
    <link rel="stylesheet" href="../css/cep.css">
</head>

<body>
    <span><?= $mensagem ?></span>

    <?php if ($dados): ?>
        <div>
            <label for="">Logradouro</label>
            <input type="text" value="<?= $dados['logradouro'] ?? '' ?>" disabled>
        </div>
        <div>
            <label for="">Complemento</label>
            <input type="text" value="<?= $dados['complemento'] ?? '' ?>" disabled>
        </div>
        <div>
            <label for="">Bairro</label>
            <input type="text" value="<?= $dados['bairro'] ?? '' ?>" disabled>
        </div>
        <div>
            <label for="">Cidade</label>
            <input type="text" value="<?= $dados['localidade'] ?? '' ?>" disabled>
        </div>
        <div>
            <label for="">Estado</label>
            <input type="text" value="<?= $dados['uf'] ?? '' ?>" disabled>
        </div>
    <?php endif; ?>
</body>
</html>




