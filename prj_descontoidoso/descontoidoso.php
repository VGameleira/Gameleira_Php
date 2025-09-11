
  <!-- 
Criar um programa que receba o nome do cliente, a idade, e o valor de compras dele. Se o cliente tiver 65 anos ou mais deverá receber um desconto
de 10%, mas apenas se o valor das compras for maior ou igual a R$1000,00.
No final o programa deverá exibir o nome do cliente, a idade, o valor das compras dele e o valor total a pagar (subtraído possível desconto).  -->


<?php

$nome = $_POST["nome"];
$idade = $_POST["idade"];
$compras = $_POST["compras"];

if ($idade >= 65 && $compras >= 1000) {
    $desconto = $compras * 0.10;
    $valorAPagar = $compras - $desconto;
} else {
    $valorAPagar = $compras;
}

echo "Nome do cliente: " . $nome . PHP_EOL . "<br>" ; 
echo "Idade: " . $idade . " anos" . PHP_EOL . "<br>" ; 
echo "Valor das compras: R$ " . $compras . PHP_EOL . "<br>"; 
echo "Valor a pagar: R$ " . $valorAPagar . PHP_EOL;

?>





