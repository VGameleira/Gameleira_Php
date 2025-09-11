<!--
Criar um programa que receba o nome do cliente, o valor da compra dele em Reais, e se o mesmo é cliente comum ou VIP. Caso seja cliente VIP, conceder um desconto de 10%. No final, deve ser mostrado o nome do cliente, o valor da compra e o valor a pagar (já subtraído o desconto).
  -->
<?php

$nome = $_POST["nome"];
$tipo = $_POST["tipo"];
$compras = $_POST["compras"];

if ($tipo == "vip") {
    $desconto = $compras * 0.10;
    $valorAPagar = $compras - $desconto;

    echo "Nome do cliente: " . $nome . PHP_EOL . "<br>";
    echo "Valor das compras: R$ " . $compras . PHP_EOL . "<br>";
    echo "Valor a pagar: R$ " . $valorAPagar;
} else {
    $valorAPagar = $compras;
    
    echo "Nome do cliente: " . $nome . PHP_EOL . "<br>";
    echo "Valor das compras: R$ " . $compras . PHP_EOL . "<br>";
}

?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../style/style.css">
<title>Desconto Vip</title>
</head>
<body>

<div id="resultado">

<h1>Desconto Vip</h1>
<p> Nome do Cliente <?$nome?>   </p>
<p> Valor das Compras <?$compras?>   </p>

<p> Valor a Pagar <?$valorAPagar?>   </p>
</div>


</body>
</html>