<?php
include_once 'imovel.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tipo']) && isset($_GET['endereco']) && isset($_GET['areaM2']) && isset($_GET['qtdQuartos'])) {
    require_once 'imovel.php';

    $tipo = $_GET['tipo'];
    $endereco = $_GET['endereco'];
    $areaM2 = floatval($_GET['areaM2']);
    $qtdQuartos = intval($_GET['qtdQuartos']);

    $imovel1 = new Imovel($tipo, $endereco, $areaM2, $qtdQuartos);
    $imovel1->mostrarInformacoes();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Imovel</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Cadastro de Imóvel</h1>
    <form action="" method="get">
    <label for="">Tipo do Imovel</label>
    <input type="text" name="tipo">
    <br>
    <label for="">Endereço</label>
    <input type="text" name="endereco">
    <br>
    <label for="">Área em Metros Quadrados</label>
    <input type="text" name="areaM2">
    <br>
    <label for="">Número de Quartos</label>
    <input type="text" name="qtdQuartos">
    <br>


        


        <button type="submit">Enviar</button>
    </form>


</body>

</html>