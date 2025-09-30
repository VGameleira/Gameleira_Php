<!-- Problema "soma" 
Fazer um programa para ler dois valores inteiros X e Y, e depois mostrar na tela o valor da soma destes 
números.  


Exemplo 1: 
Digite o valor de X: 8
Digite o valor de Y: 10
SOMA = 18 

Exemplo 2: 
Digite o valor de X: 12
Digite o valor de Y: 31
SOMA = 43 

n1 = Number.parseInt(prompt("Digite o 1º valor:"));
n2 = Number.parseInt(prompt("Digite o 2º valor:"));

soma = n1 + n2;

alert(`${n1} + ${n2} = ${soma}`); -->

<?php
$n1 = $_POST["n1"];
$n2 = $_POST["n2"];

$soma = $n1 + $n2;

echo $n1 . " + " . $n2 . " = " . $soma;
?>